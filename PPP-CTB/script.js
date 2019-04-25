var approval_url = sessionStorage.getItem('approval_url')
// document.getElementById('juros')
document.getElementById('instalments') //6
ppp = PAYPAL.apps.PPP(
{
"approvalUrl": approval_url,
"placeholder": "ppplusDiv",
"mode": "sandbox",
"payerFirstName": "Jeu",
"payerLastName": " Junior",
"payerPhone": " customerPhone",
"payerTaxId": " 35666171801",
"payerTaxIdType": "BR_CPF",
"language": "pt_BR",
"country": "BR",
"rememberedCards": "customerRememberedCardHash",
// custom
"payerEmail": "jeucasulo@hotmail.com",
// "merchantInstallmentSelectionOptional": "true",
// "merchantInstallmentSelection": "6",
});

document.getElementById('load').style.display = 'none';
