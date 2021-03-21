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
        cy.get('.mr-4.mb-1').click()
        cy.get('.v-card__title').contains('ProductForm')
        cy.get('[name=name]').type('Product 1')
        cy.get('[name=price]').type('200.00')
        cy.get('[name=quantity]').type('30')
        cy.get('.v-btn.blue--text').contains('Save').click()
        cy.wait(100)
        cy.get('table tbody tr:first-child td:nth-child(2)').contains('Product 1')
    })

    it('should edit a product', () => {
        cy.get('table tbody tr:first-child td:last-child button:nth-child(2)').click()
        cy.get('[name=name]').clear().type('Product 1 edited')
        cy.get('[name=price]').clear().type('250.00')
        cy.get('[name=quantity]').clear().type('29')
        cy.get('.v-btn.blue--text').contains('Save').click()

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