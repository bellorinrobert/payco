const express = require('express')
const router = express.Router()

router.get('/', (req, res) => {
    res.json({
        message: 'Bienvenido al Rest'
    })
})

router.post('/cliente', (req, res) => {
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