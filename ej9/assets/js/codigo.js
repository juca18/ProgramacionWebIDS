let numero = prompt("Dame un numero: ");

if (isPar(numero)) {
  alert('El numero es PAR');
}else{
  alert('El numero no es par');
}

function isPar(num) {
  if ((num%2)==0){
    return true;
  }
  return false
}