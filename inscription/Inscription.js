function validation() {

  let user= document.getElementById('user').value;
  let password= document.getElementById('password').value;
  let Confirmpassword= document.getElementById('Confirmpassword').value;
  let mobilenumber= document.getElementById('mobilenumber').value;
  let email= document.getElementById('email').value;
  let nom= document.getElementById('nom').value;
  let regex = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
  
    if (user.trim() == "") {
    document.getElementById('username').innerHTML ="Ce champ ne doit pas etre vide!";
    return false;
               
  }
   if ((user.length <=2)  ||  (user.length >=200)) {
     document.getElementById('username').innerHTML ="Le prenom d'utilisateur doit comporter entre 2 et 20 caractères "
   }else if (!isNaN(user)) {
      document.getElementById('username').innerHTML = ""
   }
  
  
   if (nom.trim() == "") {
    document.getElementById('nom').innerHTML ="Ce champ ne doit pas etre vide!";
    return false;
               
  }
   if ((nom.length <=2)  ||  (nom.length >=200)) {
     document.getElementById('nom').innerHTML ="Le nom d'utilisateur doit comporter entre 2 et 20 caractères ";
   }else if (!isNaN(nom)) {
      document.getElementById('nom').innerHTML = ""
   };
  
  
  if (password == "") {
    document.getElementById('passwordid').innerHTML ="Ce champ ne doit pas etre vide!"
     return false;
      }else if ((password.length <=4)  ||  (password.length >=200)) {
       document.getElementById('passwordid').innerHTML ="le mot de passe utilisateur doit comporter entre 4 et 200 caractères"
        return false;
      }
  
      if (Confirmpassword == "") {
         document.getElementById('Confirmpasswordid').innerHTML ="Confirmer le mot de passe"
         return false;
         }else if (password!= Confirmpassword) {
           document.getElementById('Confirmpasswordid').innerHTML ="Le mot de passe ne correspond pas"
            return false;
         }
  
      if (mobilenumber.trim() == "") {
            document.getElementById("MobileNumberid").innerHTML ="Veuiller selection un role svp!";
                return false;
      }else if(mobilenumber.trim()=""){
         document.getElementById("MobileNumberid").innerHTML =""
            return false;
      }else if (isNaN(mobilenumber)) {
          document.getElementById('MobileNumberid').innerHTML =""
            return false
      };
   }

   if (regex.test(document.getElementById('email').value)){
    document.getElementById('email').innerHTML = '';
    return true;
}
else{
    email.innerHTML = "L'adresse email incorrect!";
    email.style.color = 'red';
    return false;
}

