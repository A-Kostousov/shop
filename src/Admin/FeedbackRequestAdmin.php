<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 16.09.2018
 * Time: 20:20
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FeedbackRequestAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('email')
            ->addIdentifier('message')

            ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('email')

        ;
    }
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('message')
            ->add('email')
            ->add('feedback_request')

        ;
    }

}