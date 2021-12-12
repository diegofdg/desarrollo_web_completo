/// <reference types="cypress" />
describe('Carga la página principal', () => {
	it('Prueba el Header de la página principal', () => {
		cy.visit('/');
		
		cy.get('[data-cy="heading-sitio"]');
	});
});