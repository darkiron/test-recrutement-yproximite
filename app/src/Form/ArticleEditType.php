<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Article;
use App\Entity\ArticleCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label'    => 'label.article.title',
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label'    => 'label.article.content',
            ])
            ->add('status', ChoiceType::class, [
                'required' => true,
                'label'    => 'label.article.status',
                'choices'  => array_combine(Article::STATUSES, Article::STATUSES),
            ])
            ->add('categories', EntityType::class, [
                'required'     => true,
                'label'        => 'label.article.categories',
                'class'        => ArticleCategory::class,
                'choice_label' => fn (ArticleCategory $category) => $category->getTitle(),
                'multiple'     => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
