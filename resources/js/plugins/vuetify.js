import 'vuetify/styles' //Estilos de vuetify
import { createVuetify } from 'vuetify'
import { mdi } from 'vuetify/iconsets/mdi-svg'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        sets: {
            mdi,
        },
    },
    theme: {
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#9C27B0',
                }
            },
        },
    },
})

export default vuetify
