let prenom = document.getElementById("Prenom")   // recuperation des input 
let nom = document.getElementById("Nom")
let email = document.getElementById("Email")
let pwd = document.getElementById("Password")
let pwd1 = document.getElementById("Confirm_Password")
let role = document.getElementById("role")
let masque = document.getElementById('bouton');
let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


prenom.addEventListener('keyup', function(e){
let erreur = document.getElementById('erreur');

  if (prenom.value.trim()=='') {
    erreur.innerHTML = 'Le champ ne doit pas etre vide!';
    erreur.style.color = 'red';
    return;
  }
   erreur.innerHTML = 'ok';
   erreur.style.color = 'white';
})

nom.addEventListener('keyup', function(e){
  let erreur1 = document.getElementById('erreur1');

  if (nom.value.trim()=='') {
    erreur1.innerHTML = 'Le champ ne doit pas etre vide!';
    erreur1.style.color = 'red';
    return;
  }
   erreur1.innerHTML = 'ok';
   erreur1.style.color = 'white';
})

pwd.addEventListener('keyup', function(e){
  let erreur3 = document.getElementById('erreur3');

  if (pwd.value.trim()=='') {
    erreur3.innerHTML = 'Le champ ne doit pas etre vide!';
    erreur3.style.color = 'red';
    return;
  }
   erreur3.innerHTML = 'ok';
   erreur3.style.color = 'white';
})

pwd1.addEventListener('keyup', function(e){
  let erreur4 = document.getElementById('erreur4');

  if (pwd1.value.trim()=='') {
    erreur4.innerHTML = 'Le champ ne doit pas etre vide!';
    erreur4.style.color = 'red';
    return;
  }
   erreur4.innerHTML = 'ok';
   erreur4.style.color = 'white';
})

role.addEventListener('change', function(e){
  let erreur5 = document.getElementById('erreur5');

  if (role.value.trim()=='') {
    erreur5.innerHTML = 'Le champ ne doit pas etre vide!';
    erreur5.style.color = 'red';
    return;
  }
   erreur5.innerHTML = 'ok';
   erreur5.style.color = 'white';
})

email.addEventListener('keyup',function validmail(){
  let email = document.getElementById('Email').value;
 
  if (regex.test(email)) {
;
    document.getElementById('erreur6').innerHTML="L'adresse mail correct"
    erreur6.style.color = 'white';
  }
  else{
    document.getElementById('erreur6').innerHTML="L'adresse mail incorrect"
    erreur6.style.color = 'red';

  }
})

masque.addEventListener('mouseover',function(){

  if (nom.value.trim() =='' || prenom.value.trim() ==''|| email.value.trim() ==''|| pwd.value.trim() =='' || pwd1.value.trim() =='' || !regex.test(email)) {
    document.getElementById("bouton").disabled = true;
    masque.style.backgroundColor="white";

setTimeout(() => {

  document.getElementById("bouton").disabled = false;
  masque.style.backgroundColor="white";
}, 1000);
  
} })
