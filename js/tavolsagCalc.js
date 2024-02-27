// TavolsagCalc.js

const CharacterConverter = require('./characterConverter.js');

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
        let json = "";
        const apiKey = "25cee48f41794aeaa4872df870cf9221";

        varos = this.characterConverter.convertToEnglish(varos);

        const apiUrl = `https://api.geoapify.com/v1/geocode/search?text=${varos}&apiKey=${apiKey}`;

        try {
            let response = await fetch(apiUrl);
            if (response.ok) {
                json = await response.text();
            } else {
                json = "Hiba!";
            }
        } catch (error) {
            console.error("Fetch error:", error);
            json = "Hiba!";
        }

        return json;
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
}

module.exports = TavolsagCalc;
