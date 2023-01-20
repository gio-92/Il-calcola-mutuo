let buttonCalcolaMutuo = document.querySelector(".il-calcola-mutuo button");

if (inputColor) {
    buttonCalcolaMutuo.style.backgroundColor = inputColor;
}

// Capitale prestato x tasso annuo nominale x durata del mutuo in giorni / 365
buttonCalcolaMutuo.addEventListener("click", function (e) {
    e.preventDefault()

    let capitale = document.querySelector('#importo').value
    let interesse = document.querySelector('#interesse').value
    let anni = document.querySelector('#anni').value
    let tipoRata = document.querySelector('#tipo-rata').value
    let rate = 12
    let risultati = document.querySelector('#il-calcola-mutuo-risultati')
    let tabellaAmmortamento = document.querySelector('#il-calcola-mutuo-tabella-ammortamento')

    if (tipoRata === 'mensile' || tipoRata === 'Mensile') {
        rate = 12
    }
    else if (tipoRata === 'trimestrale' || tipoRata === 'Trimestrale') {
        rate = 4
    }
    else if (tipoRata === 'semestrale' || tipoRata === 'Semestrale') {
        rate = 2
    }
    else if (tipoRata === 'annuale' || tipoRata === 'Annuale') {
        rate = 1
    }
    else {
        rate = 12
    }

    interesse = interesse / 100
    let interesseRateizzato = interesse / rate
    let importoRata = capitale * interesseRateizzato / (1 - 1 / Math.pow(1 + interesseRateizzato, anni * rate))

    importoRata = Math.round(importoRata * 100) / 100

    importoRataStringa = importoRata.toFixed(2)

    totale = importoRata * anni * rate
    totale = Math.round(totale * 100) / 100
    totaleStringa = totale.toFixed(2)

    risultati.innerHTML = `
    Rate: ${anni * rate} <br />
    Importo rata: ${importoRataStringa} € <br />
    Totale da rimborsare: ${totaleStringa} € <br />
    `

    // Piano di ammortamento
    let ammortamento = calcoloPiano(importoRata, (anni * rate), capitale, interesseRateizzato);
    let tabella = `
        <table class='tabella-ammortamento table-bordered'>
            <tr>
                <th>N. RATA</th>
                <th>DEBITO RESIDUO</th>
                <th>QUOTA CAPITALE</th>
                <th>QUOTA INTERESSI</th>
                <th>RATA</th>
            </tr>
    `;
    // Riempimento tabella
    for (let i = 0; i < ammortamento[0].length; i++) {
        tabella = tabella + `
            <tr>
                <td>${ammortamento[0][i]}</td>
                <td>${ammortamento[1][i]} €</td>
                <td>${ammortamento[2][i]} €</td>
                <td>${ammortamento[3][i]} €</td>
                <td>${ammortamento[4][i]} €</td>
            </tr>
        `;
    }
    tabella = tabella + `</table>`;

    function calcoloPiano(importoRata, numeroRate, capitale, interesseRateizzato) {
        // Calcolo ammortamento
        let ammortamento = [
            [], // N. rata
            [], // Debito residuo
            [], // Quota capitale
            [], // Quota interessi
            [], // Rata
        ];

        let i = 0; // Contatore
        let Ii = 0; // Quota interessi
        let Ci = 0; // Quota capitale
        let Di = capitale; // Debito residuo
        let Ei = 0; // Debito estinto

        for (i = 0; i < numeroRate; i++) {
            Ii = Math.round((interesseRateizzato * Di) * 100) /100;
            Ci = Math.round((importoRata - Ii) * 100) / 100;
            Di = Di - Ci;
            Ei = Ei + Ci;

            ammortamento[0][i] = i + 1;
            ammortamento[1][i] = Number(Di).toFixed(2);
            ammortamento[2][i] = Number(Ci).toFixed(2);
            ammortamento[3][i] = Number(Ii).toFixed(2);
            ammortamento[4][i] = Number(importoRata).toFixed(2);
        }

        return ammortamento;
    }

    // Inserisci tabella con piano di ammortamento nell'HTML
    tabellaAmmortamento.innerHTML = tabella

    let th = document.querySelectorAll("#il-calcola-mutuo-tabella-ammortamento th");
    let even = document.querySelectorAll('#il-calcola-mutuo-tabella-ammortamento tr:nth-child(even)');

    if (inputColor) {
        for (let i = 0; i < th.length; i++) {
            th[i].style.backgroundColor = inputColor;
        }
        for (let i = 0; i < even.length; i++) {
            even[i].style.backgroundColor = inputColor + '19';
        }
    }

})