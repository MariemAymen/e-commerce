<?php

namespace App\Controller\Admin;

use App\Entity\CartItems;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CartItemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CartItems::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('product.id', 'product'),
            IntegerField::new('quantity', 'Quantité'),
            MoneyField::new('prix', 'Prix')->setCurrency('EUR'),
            DateTimeField::new('addedAt', 'Ajouté le'),
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
