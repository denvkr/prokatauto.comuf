<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

namespace AppBundle\Entity;

/**
 * Description of UserLogin
 *
 * @author Нехай
 */
class UserLogin {
    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
     protected $login;
}
