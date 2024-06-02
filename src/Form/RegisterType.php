<?php

namespace App\Form;

use App\Entity\Login;
use App\Entity\User;
use Faker\Provider\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Usuario',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese un nombre de usuario',
                    ]),
                ],
            ])
            ->add('user', UserType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese un email',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese una contraseña',
                    ]),
                ],
            ])
            ->add('cookies', CheckboxType::class, [
                'label' => 'Acepto las condiciones de uso y privacidad.',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debe aceptar las condiciones de uso',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Login::class,
        ]);
    }
}
