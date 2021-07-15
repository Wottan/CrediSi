describe('Login test', () => {
    it('Button "Iniciar sesion con Goolge" check', () => {
        cy.visit('/')
        cy.contains('Iniciar sesion con Google ')
    })
})
