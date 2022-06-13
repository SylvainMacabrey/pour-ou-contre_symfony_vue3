<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private function listQuestions(): array
    {
        return [
            'Pour ou contre le PACS ?',
            'Pour ou contre l’arrêt du changement heure été/heure hiver ?',
            'Pour ou contre le don d’organes après sa mort ?',
            'Pour ou contre Miss France ?',
            'Pour ou contre l’abolition des écoles privées ?',
            'Pour ou contre le travail à domicile ?',
            'Pour ou contre la paie pour les mères au foyer ?',
            'Pour ou contre la cryptomonnaie ?',
            'Pour ou contre le véganisme ?',
            'Pour ou contre les centres-villes exclusivement piétons ?',
            'Pour ou contre la fermeture des zoos ?',
            'Pour ou contre le retour à la monarchie ?',
            'Pour ou contre l’abolition des frontières pour les personnes ?',
            'Pour ou contre les réseaux sociaux ?',
            'Pour ou contre l’adoption des taxes sur les capitaux ?',
            'Pour ou contre la fermeture des fast-foods ?',
            'Pour ou contre l’homéopathie ?',
            'Pour ou contre la chirurgie esthétique ?',
            'Pour ou contre l’école à la maison ?',
            'Pour ou contre les activités sportives gratuites pour tous les enfants ?',
            'Pour ou contre les animaux domestiques en appartement ?',
            'Pour ou contre l’utilisation des tablettes en classe ?',
            'Pour ou contre les devoirs à la maison ?',
            'Pour ou contre l’élargissement de l’Europe ?',
            'Pour ou contre la surveillance digitale des écoles ?',
            'Pour ou contre l’obligation d’utilisation des transports publics ?',
            'Pour ou contre le téléphone pour les enfants ?',
            'Pour ou contre les armes à feu pour les civils ?',
            'Pour ou contre les tests sur les animaux ?',
            'Pour ou contre les sites de rencontres ?',
            'Pour ou contre la spiritualité ?',
            'Pour ou contre l’huile de chanvre ?',
            'Pour ou contre les cigarettes ?',
            'Pour ou contre l’alcool ?',
            'Pour ou contre les relations sans lendemain ?',
            'Pour ou contre les amis avec bénéfices ?',
            'Pour ou contre la célébrité ?',
            'Pour ou contre la séparation des régions ?',
            'Pour ou contre l’Internet gratuit ?',
            'Pour ou contre l’instauration d’un revenu universel ?',
            'Pour ou contre les taxes sur les sucreries ?',
            'Pour ou contre les parcs en centre-ville ?',
            'Pour ou contre Instagram ?',
            'Pour ou contre les régimes diététiques ?',
            'Pour ou contre les boissons gazeuses ?',
            'Pour ou contre le passage exclusif aux voitures électriques ?',
            'Pour ou contre la fermeture totale des frontières ?',
            'Pour ou contre le droit de vote pour tous les résidents du territoire français ?',
            'Pour ou contre la double nationalité ?',
            'Pour ou contre la séparation de l’Europe ?',
            'Pour ou contre l’amitié entre un homme et une femme ?',
            'Pour ou contre la solidarité féminine ?',
            'Pour ou contre les amis avant les partenaires amoureux ?',
           ' Pour ou contre les câlins entre amis ?',
            'Pour ou contre les soirées ragots ?',
            'Pour ou contre les cours en ligne payants ?',
            'Pour ou contre l’existence de Dieu ?',
            'Pour ou contre le casino ?',
            'Pour ou contre le ghosting ?',
            'Pour ou contre le fétichisme ?',
            'Pour ou contre rester ami(e) avec son ex ?',
            'Pour ou contre le polyamour ?',
            'Pour ou contre les orgies ?',
            'Pour ou contre la polygamie ?',
            'Pour ou contre le préservatif ?',
            'Pour ou contre la contraception féminine ?',
            'Pour ou contre le sexe après le mariage ?',
            'Pour ou contre l’infidélité émotionnelle ?',
            'Pour ou contre l’utilisation d’un seul compte Facebook ?',
            'Pour ou contre la vie à deux ?',
            'Pour ou contre le coup de foudre ?',
            'Pour ou contre la vie sans enfants ?',
            'Pour ou contre un film érotique à deux ?',
            'Pour ou contre les lits séparés ?',
            'Pour ou contre les cadeaux romantiques ?',
            'Pour ou contre l’existence de l’âme sœur ?',
            'Pour ou contre le sacrifice par amour ?',
            'Pour ou contre le divorce ?',
            'Pour ou contre la différence d’âge ?',
            'Pour ou contre la vérité absolue ?',
            'Pour ou contre les ultimatums amoureux ?',
            'Pour ou contre les sorties séparées ?',
            'Pour ou contre le choix égoïste dans un couple ?',
            'Pour ou contre la domination/la soumission ?',
            'Pour ou contre chacun dans son appartement ?',
            'Pour ou contre l’affichage du couple sur les réseaux sociaux ?',
            'Pour ou contre la garde partagée des enfants ?',
            'Pour ou contre les rendez-vous doubles ?',
            'Pour ou contre la vie avec la belle-famille ?',
            'Pour ou contre le rendez-vous arrangé ?',
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $questions = $this->listQuestions();
        foreach($questions as $q) {
            $question = new Question();
            $question->setContent($q);
            $manager->persist($question);
        }

        $manager->flush();
    }
}
