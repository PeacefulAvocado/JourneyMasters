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

module.exports = CharacterConverter;
