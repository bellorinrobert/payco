const express = require('express')
const router = express.Router()
const {getSoap, getApi } = require('../utils')

router.get('/', (req, res) => {
    res.json({
        message: 'Bienvenido al Rest'
    })
})

router.post('/soap', async (req, res) => {
    try {
        const {a, b } = req.body
        const mySoap = await getSoap(a, b);
        
        res.json({
            'success': true,
            'add': mySoap['SOAP-ENV:Envelope']['SOAP-ENV:Body'][0]['ns1:addResponse'][0]['return'][0]['_'],
            
        })

    } catch (error) {
        res.status(500).json(
            'Error procesing data'
        )
    }
    
})

router.post('/cliente', async (req, res) => {
    
    try {
        const {documento, nombres, email, celular } = req.body
        const api = await getApi({documento, nombres, email, celular}
            ,'http://localhost:8000/cliente'
        )
        
        res.json({
            'success': true,
            'api': api
        })

    } catch (error) {
        res.status(500).json(
            'Error procesing data'
        )
    }
    
})

router.post('/wallet/credit', async (req, res) => {
    try {
        const {documento, celular, valor } = req.body

        const api = await getApi({documento, celular, valor}
            ,'http://localhost:8000/wallet/credit'
        )
        
        res.json({
            'success': true,
            'api': api
        })

    } catch (error) {
        res.status(500).json(
            'Error procesing data'
        )
    }
})

router.post('/wallet/debit', async (req, res) => {
    try {
        const {documento, monto } = req.body

        const api = await getApi({documento, monto}
            ,'http://localhost:8000/wallet/debit'
        )
        
        res.json({
            'success': true,
            'api': api
        })

    } catch (error) {
        res.status(500).json(
            'Error procesing data'
        )
    }
})

router.post('/wallet/confirm', async (req, res) => {
    try {
        const {session_id, token } = req.body

        const api = await getApi({session_id, token}
            ,'http://localhost:8000/wallet/confirm'
        )
        
        res.json({
            'success': true,
            'api': api
        })

    } catch (error) {
        res.status(500).json(
            'Error procesing data'
        )
    }
})

router.post('/wallet/consult', async (req, res) => {
    try {
        const {documento, celular } = req.body

        const api = await getApi({documento, celular}
            ,'http://localhost:8000/wallet/consult'
        )
        
        res.json({
            'success': true,
            'api': api
        })

    } catch (error) {
        res.status(500).json(
            'Error procesing data'
        )
    }
})

module.exports = router