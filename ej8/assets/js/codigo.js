let palabra = prompt("Dame una palabra: ");

if (isPalindrome(palabra)) {
  alert('La palabra es palindrome');
}else{
  alert('La palabra NO es palindrome');
}

function isPalindrome(cadena) {
  var palabra = cadena.split(' ').join('').toLowerCase();

  let palabra2 = ''
  for (let i = palabra.length; i >= 0; i--) {
    palabra2 = palabra2 + palabra.charAt(i);
  }  

  if (palabra==palabra2){
    return true;
  }
  return false

 
}