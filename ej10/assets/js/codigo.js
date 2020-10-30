let mensaje = prompt("Dame la palabra: ");

alert(checkPalabra(mensaje))

function checkPalabra(palabra) {

  if(palabra == palabra.toUpperCase()){
    return 'El texto esta en mayusculas'
  }
  if(palabra == palabra.toLowerCase()){
    return 'El texto esta en minusculas'
  }else{
    return 'El texto tiene mayusculas y minusculas'
  }
}