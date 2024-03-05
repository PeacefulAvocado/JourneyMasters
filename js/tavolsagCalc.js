class TavolsagCalc {
    constructor() {
        this.characterConverter = new CharacterConverter();
    }

    async varosLekerdez(varos) {
        let json = await this.getJson(varos);
        let seged = json.split('"');
        let i = 0;

        while (seged[i] !== "lon") {
            i++;
        }

        let lon = "";
        for (let j = 1; j < seged[i + 1].length - 1; j++) {
            if (seged[i + 1][j] === '.') {
                lon += ",";
            } else {
                lon += seged[i + 1][j];
            }
        }

        let lat = "";
        for (let j = 1; j < seged[i + 3].length - 1; j++) {
            if (seged[i + 3][j] === '.') {
                lat += ",";
            } else {
                lat += seged[i + 3][j];
            }
        }

        return lon + ";" + lat;
    }

    async getJson(varos) {
        return new Promise((resolve, reject) => {
            let json = "";
            const apiKey = "25cee48f41794aeaa4872df870cf9221";

            varos = this.characterConverter.convertToEnglish(varos);

            const apiUrl = `https://api.geoapify.com/v1/geocode/search?text=${varos}&apiKey=${apiKey}`;

            fetch(apiUrl)
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    } else {
                        throw new Error("Network response was not ok.");
                    }
                })
                .then(data => {
                    resolve(data);
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    reject("Hiba!");
                });
        });
    }

    async getContinent(varos) {
        let json = await this.getJson(varos);
        let seged = json.split('"');
        let continents = ["Africa", "Antarctica", "Asia", "Europe", "America", "Australia"];
        let continent = "";

        for (let i = 0; i < seged.length; i++) {
            for (let j = 0; j < continents.length; j++) {
                if (seged[i].includes(continents[j])) {
                    continent = continents[j];
                    return continent.toString();
                }
            }
        }

        return continent;
    }

    async isPlaneOnly(start_place, end_place) {
        let strtCtn = await this.getContinent(start_place);
        let endCtn = await this.getContinent(end_place);

        const eurasiafr = ["Europe", "Asia", "Africa"];

        if (eurasiafr.includes(strtCtn) && eurasiafr.includes(endCtn)) {
            return false;
        } else if (strtCtn === endCtn) {
            return false;
        } else {
            return true;
        }
    }

    async calcDistance(start_place, end_place) {
        const EarthRadius = 6371;

        let start_coord = await this.varosLekerdez(start_place);
        let end_coord = await this.varosLekerdez(end_place);

        let start_lon = this.toRadians(parseFloat(start_coord.split(';')[0]));
        let start_lat = this.toRadians(parseFloat(start_coord.split(';')[1]));
        let end_lon = this.toRadians(parseFloat(end_coord.split(';')[0]));
        let end_lat = this.toRadians(parseFloat(end_coord.split(';')[1]));

        let delta_lon = start_lon - end_lon;
        let delta_lat = start_lat - end_lat;

        let a = Math.pow(Math.sin(delta_lat / 2), 2) + Math.cos(start_lat) * Math.cos(end_lat) * Math.pow(Math.sin(delta_lon / 2), 2);
        let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        let distance = EarthRadius * c;
        return distance;
    }

    toRadians(degrees) {
        return degrees * Math.PI / 180.0;
    }

    // Additional methods can be added here as needed

}
class CharacterConverter {
    constructor() {
        this.latinToEnglishMap = new Map([
            ['á', 'a'],
            ['é', 'e'],
            ['í', 'i'],
            ['ó', 'o'],
            ['ú', 'u'],
            ['ü', 'u'],
            ['ñ', 'n'],
            ['ç', 'c'],
            ['ã', 'a'],
            ['à', 'a'],
            ['â', 'a'],
            ['è', 'e'],
            ['ê', 'e'],
            ['î', 'i'],
            ['ô', 'o'],
            ['û', 'u'],
            ['ő', 'o'],
            ['ű', 'u'],
            ['ş', 's'],
            ['ğ', 'g'],
            ['ı', 'i'],
            ['ć', 'c'],
            ['č', 'c'],
            ['š', 's'],
            ['ž', 'z'],
            ['ä', 'a'],
            ['ö', 'o'],
            ['å', 'a']
        ]);
    }

    convertToEnglish(input) {
        let result = '';

        for (let char of input) {
            if (this.latinToEnglishMap.has(char)) {
                result += this.latinToEnglishMap.get(char);
            } else {
                result += char;
            }
        }

        return result;
    }
}

