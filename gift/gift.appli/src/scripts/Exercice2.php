<?php


echo "Question 1";


echo "Question 2";
foreach (Prestation::with('categorie')->get() as $prestation) {
    echo $prestation->libelle . "{$prestation->categorie->libelle}\n";
    echo $prestation->description . "\n";
}