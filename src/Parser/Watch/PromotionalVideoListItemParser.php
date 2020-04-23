<?php

namespace Jikan\Parser\Watch;

use Jikan\Helper\JString;
use Jikan\Helper\Parser;
use Jikan\Model\Watch\EpisodeListItem;
use Jikan\Model\Watch\RecentEpisodeListItem;
use Jikan\Parser\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class PromotionalVideoListItemParser
 *
 * @package Jikan\Parser
 */
class PromotionalVideoListItemParser implements ParserInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * PromotionalVideoListItemParser constructor.
     *
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return EpisodeListItem
     * @throws \Exception
     * @throws \RuntimeException
     */
    public function getModel(): EpisodeListItem
    {
        return EpisodeListItem::fromParser($this);
    }

    /**
     * @return int
     * @throws \InvalidArgumentException
     */
    public function getId(): int
    {
        return Parser::idFromUrl($this->getUrl());
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getUrl(): string
    {
        $node = $this->crawler->filterXPath('//div[@class="video-info-title"]/a[2]');
        return $node->attr('href');
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getTitle(): string
    {
        $node = $this->crawler->filterXPath('//div[@class="video-info-title"]/a[2]');
        return $node->text();
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getImageUrl(): string
    {
        return Parser::parseImageQuality(
            $this->crawler->filterXPath('//div[contains(@class, "video-list")]/img')->attr('data-src')
        );
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getImages(): string
    {
        return Parser::parseImageQuality(
            $this->crawler->filterXPath('//div[contains(@class, "video-list")]/img')->attr('data-src')
        );
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getPromoMedia(): array
    {
        return [];
    }

    public function getPromoTitle(): string
    {
        return "";
    }


}
