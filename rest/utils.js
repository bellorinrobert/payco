
async function  getSoap(a, b){

    const xml2js = require('xml2js')

    const url = 'http://localhost:8000/soap'; // Reemplaza con la URL de tu servicio SOAP
    
    const soapRequest = `<?xml version="1.0"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Header/>
            <soap:Body>
                <add xmlns="http://localhost:8000/soap">
                    <a>${a}</a>
                    <b>${b}</b>
                </add>
            </soap:Body>
        </soap:Envelope>`;
        
    const accion = 'http://localhost:8000/add'

    try {
        const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'text/xml;charset=UTF-8',
                    'SOAPAction': accion 
                },
                body: soapRequest
            })

        if(!response.ok){
            throw new Error('Error soap no ok')
        }

        const data = await response.text();
        const json = await xml2js.parseStringPromise(data)
        return json

    } catch (error) {
        throw new Error('Fetchh error' + error.message)
    }


    // await fetch(url, {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'text/xml;charset=UTF-8',
    //         'SOAPAction': accion // Reemplaza con la acción SOAP correcta
    //     },
    //     body: soapRequest
    // })
    // .then(response => response.text())
    // .then(responseText => {
    //     // console.log('Respuesta:', responseText);
    //     xml2js.parseString(responseText, (err, result) => {
    //         if(err){
    //             console.error('Error als parsear el XML', err)
    //             return
    //         }

    //         console.log('Resultado', result['SOAP-ENV:Envelope']['SOAP-ENV:Body'][0]['ns1:addResponse'][0]['return'][0]['_'])
    //         return result['SOAP-ENV:Envelope']['SOAP-ENV:Body'][0]['ns1:addResponse'][0]['return'][0]['_']
    
    
    //     })
    // })
    // .catch(error => {
    //     console.error('Error en la solicitud SOAP:', error);
    // });

}

async function getApi(body, url){
    
    try {
        
        const response = await fetch(url, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',  // Indicar que estamos enviando JSON
                },
                body: JSON.stringify(body)
            })

        const data = await response.json();
        
        return data

    } catch (error) {
        console.error("error", error)
        return error
    }
}

module.exports = {
    getSoap
    , getApi
}