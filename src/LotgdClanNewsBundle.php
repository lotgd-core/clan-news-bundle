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

namespace Lotgd\Bundle\ClanNewsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Lotgd\Bundle\Contract\LotgdBundleInterface;
use Lotgd\Bundle\Contract\LotgdBundleTrait;

final class LotgdClanNewsBundle extends Bundle implements LotgdBundleInterface
{
    use LotgdBundleTrait;

    public const TRANSLATION_DOMAIN = 'lotgd_clan_news';

    /**
     * {@inheritDoc}
     */
    public function getLotgdName(): string
    {
        return 'Clan News';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdVersion(): string
    {
        return '0.1.0';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdDescription(): string
    {
        return 'Show last news of member of clan in Clan Hall.';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdDownload(): ?string
    {
        return 'https://github.com/lotgd-core/clan-news-bundle';
    }
}
