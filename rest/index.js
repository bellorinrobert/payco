const express = require('express')
const app = express()
const PORT = process.env.PORT || 3000

const routes = require('./routes/web')

app.use(express.json())

app.use('/', routes)

app.listen(PORT, () => {
    console.info(
        `Servidor escuchando en http://localhost:${PORT}`
    )
})