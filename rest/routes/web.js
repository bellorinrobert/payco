const express = require('express')
const router = express.Router()
const getSoap = require('../utils')

router.get('/', (req, res) => {
    res.json({
        message: 'Bienvenido al Rest'
    })
})

router.post('/cliente', async (req, res) => {
    try {
        const {documento, nombres, email, celular, a, b, opera } = req.body
        const mySoap = await getSoap(a, b, opera);
        res.json({
            'success': true,
            'add': mySoap['SOAP-ENV:Envelope']['SOAP-ENV:Body'][0]['ns1:addResponse'][0]['return'][0]['_']
        })

    } catch (error) {
        res.status(500).send(
            'Error procesing data'
        )
    }
    
})

router.post('/billetera/recargar', (req, res) => {
    const {documento, nombres, email, celular } = req.body
    res.json({
        success: true,
        data: {
            id: 1,
            documento: documento,
            nombres: nombres,
            email: email,
            celular: celular,
        }
    })
})

router.post('/billetera/pagar', (req, res) => {
    const {documento, nombres, email, celular } = req.body
    res.json({
        success: true,
        data: {
            id: 1,
            documento: documento,
            nombres: nombres,
            email: email,
            celular: celular,
        }
    })
})

router.post('/billetera/confirmar', (req, res) => {
    const {documento, nombres, email, celular } = req.body
    res.json({
        success: true,
        data: {
            id: 1,
            documento: documento,
            nombres: nombres,
            email: email,
            celular: celular,
        }
    })
})

router.post('/billetera/consultar', (req, res) => {
    const {documento, nombres, email, celular } = req.body
    res.json({
        success: true,
        data: {
            id: 1,
            documento: documento,
            nombres: nombres,
            email: email,
            celular: celular,
        }
    })
})

module.exports = router