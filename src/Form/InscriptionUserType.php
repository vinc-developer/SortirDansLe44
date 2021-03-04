<?php

namespace App\Form;

use App\Entity\Personne;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>"Email de l'utilisateur"
            ])
            ->add('password', PasswordType::class, [
                'label'=>"Password de l'Utilisateur"
            ])
            ->add('nom', TextType::class, [
                'label'=>"nom de l'utilisateur"
            ])
            ->add('prenom', TextType::class, [
                'label'=>"Prenom de l'utilisateur"
            ])
            ->add('telephone', TextType::class, [
                'label'=>"Telephone de l'utilisateur"
            ])
            ->add('admin')
            ->add('actif')
            //->add('avatarUrl', ['label'=>"Url"])
            //->add('campus')
            ->add('submit', SubmitType::class,[
                'label'=>"Ajouter l'utilisateur"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
