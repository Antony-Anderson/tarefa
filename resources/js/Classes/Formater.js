export default class Formater {
    data(data) {
        // Verifica se a entrada é uma instância válida de Date
        if(!(data instanceof Date)){
            data = new Date(data);
        }
        if (isNaN(data)) {
          return "Data inválida";
        }
        data.setDate(data.getDate() + 1);
        let dia = data.getDate().toString().padStart(2, '0');
        let mes = (data.getMonth() + 1).toString().padStart(2, '0');
        let ano = data.getFullYear();
        return `${dia}/${mes}/${ano}`;
    }

    dinheiro(numero) {
        // Verifica se o número é válido
        if (isNaN(numero)) {
            return "Número inválido";
        }
        
        // Formata o número como moeda brasileira
        return Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(numero)
    }

    vMoneyConfig(){
        return {
            masked: false,
            prefix: 'R$ ',
            suffix: '',
            thousands: '.',
            decimal: ',',
            precision: 2,
            disableNegative: false,
            disabled: false,
            min: null,
            max: null,
            allowBlank: false,
            minimumNumberOfCharacters: 0,
            shouldRound: true,
            focusOnRight: false,
          }
    }
}