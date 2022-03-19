<?php

/**
 * Class User permettant la récuperation et la modification des propriétés de la classe de
 * définit également la table SQL concernée dans le "modèle mére"
 */
class UsersModel extends Model
{
   protected $id;
   protected $email;
   protected $prenom;
   protected $nom;
   protected $password;

   /**
    * Définit la table SQL concernée dans le modèle mère"
    */
   public function __construct()
   {
      $this->table = 'users';
   }

   /**
    * Get the value of password
    */ 
   public function getPassword()
   {
      return $this->password;
   }

   /**
    * Set the value of password
    *
    * @return  self
    */ 
   public function setPassword($password)
   {
      $this->password = $password;

      return $this;
   }

   /**
    * Get the value of email
    */ 
   public function getEmail()
   {
      return $this->email;
   }

   /**
    * Set the value of email
    *
    * @return  self
    */ 
   public function setEmail($email)
   {
      $this->email = $email;

      return $this;
   }

   /**
    * Get the value of id
    */ 
   public function getId()
   {
      return $this->id;
   }

   /**
    * Set the value of id
    *
    * @return  self
    */ 
   public function setId($id)
   {
      $this->id = $id;

      return $this;
   }

   /**
    * Get the value of prenom
    */ 
   public function getPrenom()
   {
      return $this->prenom;
   }

   /**
    * Set the value of prenom
    *
    * @return  self
    */ 
   public function setPrenom($prenom)
   {
      $this->prenom = $prenom;

      return $this;
   }

   /**
    * Get the value of nom
    */ 
   public function getNom()
   {
      return $this->nom;
   }

   /**
    * Set the value of nom
    *
    * @return  self
    */ 
   public function setNom($nom)
   {
      $this->nom = $nom;

      return $this;
   }

   /**
    * Get the value of adresse
    */ 
   public function getAdresse()
   {
      return $this->adresse;
   }

   /**
    * Set the value of adresse
    *
    * @return  self
    */ 
   public function setAdresse($adresse)
   {
      $this->adresse = $adresse;

      return $this;
   }

   /**
    * Update du profil user pour récupération de mot de passe par mail
    *
    * @param [type] $password
    * @param [type] $email
    * @return void 
    */
   public function emailPassword($password, $email)
   {
      return $this->requete(" UPDATE users SET password = ? WHERE email = ?", array($password, $email));
   }
}