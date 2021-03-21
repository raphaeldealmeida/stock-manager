describe('Page Products', () =>{
    before(() => {
        // cy.exec('npm run db:refresh', {log: true})
    })

    beforeEach(() => {
        cy.visit('http://localhost:8080/')
        cy.get('[name=email]').clear()
        cy.get('[name=email]').type('admin@admin.com')
        cy.get('[name=password]').clear()
        cy.get('[name=password]').type('12345678')
        cy.contains('login').click()

    })

    it('should list all products', () => {
        cy.get('table tbody tr').should('have.length', 5)
    })

    it('should create a new product', () => {
        cy.get('[data-cy=btn-product-create]').click()
        cy.get('.v-card__title').contains('ProductForm')
        cy.get('[data-cy=code]').type('ABC123')
        cy.get('[data-cy=name]').type('Product 1')
        cy.get('[data-cy=price]').type('200.00')
        cy.get('[data-cy=quantity]').type('30')
        cy.get('[data-cy=btn-product-save]').contains('Save').click()
        cy.wait(1000)
        cy.get('table tbody tr:first-child td:nth-child(2)').contains('Product 1')
    })

    it('should edit a product', () => {
        cy.get('table tbody tr:first-child td:last-child button:nth-child(2)').click()
        cy.get('[data-cy=name]').clear().type('Product 1 edited')
        cy.get('[data-cy=price]').clear().type('250.00')
        cy.get('[data-cy=quantity]').clear().type('29')
        cy.get('[data-cy=btn-product-save]').contains('Save').click()

        cy.get('table tbody tr:first-child td:nth-child(2)').contains('Product 1 edited')
        cy.get('table tbody tr:first-child td:nth-child(3)').contains('250.00')
        cy.get('table tbody tr:first-child td:nth-child(4)').contains('29')
    })

    it('should delete a product', () => {
        cy.get('table tbody tr:first-child td:last-child button:nth-child(3)').click()
        cy.get('div.v-card__text').contains('Product 1 edited')
        cy.get('button.v-btn.error').contains('Yeh').click()
        cy.get('table tbody tr:first-child td:nth-child(2)').should('not.eq','Product 1 edited')
    })

})