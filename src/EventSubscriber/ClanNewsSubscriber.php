<?php

/**
 * This file is part of "LoTGD Bundle Clan News".
 *
 * @see https://github.com/lotgd-core/clan-news-bundle
 *
 * @license https://github.com/lotgd-core/clan-news-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Lotgd\Bundle\ClanNewsBundle\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Lotgd\Bundle\ClanNewsBundle\LotgdClanNewsBundle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class ClanNewsSubscriber implements EventSubscriberInterface
{
    public const TRANSLATION_DOMAIN = LotgdClanNewsBundle::TRANSLATION_DOMAIN;

    private $doctrine;
    private $parameter;

    public function __construct(EntityManagerInterface $doctrine, ParameterBagInterface $parameter)
    {
        $this->doctrine  = $doctrine;
        $this->parameter = $parameter;
    }

    public function showNews(GenericEvent $event)
    {
        global $session, $claninfo;

        $maxNews = $this->parameter->get('lotgd_bundle.clan_news.max_news');
        /** @var \Lotgd\Core\Repository\NewsRepository */
        $repository = $this->doctrine->getRepository('LotgdCore:News');
        $query      = $repository->createQueryBuilder('u');
        $expr       = $query->expr();

        $query->select('u')
            ->innerJoin('LotgdCore:User', 'a', 'with', $expr->eq('a.acctid', 'u.accountId'))
            ->innerJoin('LotgdCore:Avatar', 'c', 'with', $expr->eq('c.id', 'a.avatar'))
            ->where('c.clanid = :clan')
            ->orderBy('u.date', 'DESC')

            ->setMaxResults($maxNews)

            ->setParameter('clan', $session['user']['clanid'])
        ;

        $data = $event->getArguments();

        $data['templates']['@LotgdClanNews/news_clan_hall.html.twig'] = [
            'translation_domain' => self::TRANSLATION_DOMAIN,
            'name'               => $claninfo['clanname'],
            'result'             => $query->getQuery()->getArrayResult(),
        ];

        $event->setArguments($data);
    }

    public static function getSubscribedEvents()
    {
        return [
            'clanhall' => 'showNews',
        ];
    }
}
