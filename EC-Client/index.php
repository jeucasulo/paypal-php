<div id="paypal-button"></div>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script>
	paypal.Button.render({
	// Configure environment
	env: 'sandbox',
	client: {
	sandbox: 'AXIsUBA7y1nwLfHyX55vclufcPNy_rMNdngZ6StF4nwX-OvpoB7sm3jfVv57VWBwUeVpo2guhySrcb_c',
	production: ''
	},
	shipping_address: {
	recipient_name: 'Usuário Teste',
	line1: ', 354 Casa',
	line2: 'Vila Alpina',
	city: 'São Paulo',
	country_code: 'BR',
	postal_code: '03204030',
	phone: '',
	state: 'SP'
	},
	// Customize button (optional)
	locale: 'pt_BR',
	style: {
	size: 'small',
	color: 'gold',
	shape: 'pill',
	},
	//https://developer.paypal.com/docs/checkout/integration-features/customize-button/
	
	// Enable Pay Now checkout flow (optional)
	commit: true,
	
	// Set up a payment
	payment: function(data, actions) {
	return actions.payment.create({
	transactions: [{
	amount: {
	total: '155.4',
	currency: 'BRL',
	details: {
	subtotal: '155.4',
	tax: '0.00',
	shipping: '0.00',
	handling_fee: '0.00',
	shipping_discount: '0.00',
	insurance: '0.00'
	}
	},
	description: 'Compra na loja Porta Perfumes',
	custom: '8572060',
	invoice_number: '915604',
	payment_options: {
	allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
	},
	soft_descriptor: 'ECHI5786786',
	item_list: {
	items: [
	{
	name: 'Perfume 5 ml',
	description: 'Decant / Amostra do Perfume Masculino Joop! Homme Eau de Toilette (EDT) 5 ml',
	quantity: '3',
	price: '15.90',
	tax: '0.00',
	sku: 'PP_37',
	currency: 'BRL'
	},
	{
	name: 'Perfume 2,5 ml',
	description: 'Decant / Amostra do Perfume Unissex Prada Les Infusions Amande Eau de Parfum (EDP) 2,5 ml',
	quantity: '3',
	price: '24.90',
	tax: '0.00',
	sku: 'PP_38',
	currency: 'BRL'
	},
	{
	name: 'Frete',
	description: 'SEDEX',
	quantity: '1',
	price: '33.00',
	tax: '0.00',
	sku: 'Correios',
	currency: 'BRL'
	}],

	}
	}],
	});
	},
	// Execute the payment
	onAuthorize: function(data, actions) {
	return actions.payment.execute().then(function() {
	// Show a confirmation message to the buyer
	window.alert('A Porta Perfumes agradece sua Compra!');
	});
	}
	}, '#paypal-button');
	
	</script>
