<?php

/**
 * Copyright 2018 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace LINE\LINEBot\KitchenSink\EventHandler\MessageHandler\Flex;

use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\Constant\Flex\ComponentButtonStyle;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentGravity;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectMode;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectRatio;
use LINE\LINEBot\Constant\Flex\ComponentImageSize;
use LINE\LINEBot\Constant\Flex\ComponentLayout;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;

class FlexIuran
{
    private static $items = [
        '111' => [
            'name' => 'Erza Putra Albasori',
            'iuran' => '40.000',
        ],
        '112' => [
            'name' => 'Muhammad Naufal',
            'iuran' => '100.000',
        ],
        '113' => [
            'name' => 'Mufti Alie S',
            'iuran' => '60.000',
        ],

    ];

    /**
     * Create sample shopping flex message
     *
     * @return \LINE\LINEBot\MessageBuilder\FlexMessageBuilder
     */
    public static function get()
    {
        return FlexMessageBuilder::builder()
        ->setAltText('info')
        ->setContents(new CarouselContainerBuilder([
            self::createItemBubble(111),
        ]));
    }

    private static function createItemBubble($itemId)
    {
        $item = self::$items[$itemId];
        return BubbleContainerBuilder::builder()
        ->setHeader(self::createItemHeaderBlock($item))
        ->setBody(self::createItemBodyBlock($item))
        ->setFooter(self::createItemFooterBlock($item));
    }

//nama
    private static function createItemBodyBlock($item)
    {

        for ($i=0; $i < 5; $i++) { 

            $components[] = BoxComponentBuilder::builder()
            ->setLayout(ComponentLayout::BASELINE)
            ->setContents([
                TextComponentBuilder::builder()
                ->setText(($i+1).'. '.$item['name'])
                ->setWrap(true)
                ->setColor('#f77f00')
                ->setFlex(0)
                ->setWeight(ComponentFontWeight::REGULAR)
                ->setSize(ComponentFontSize::SM)
                ->setMargin(ComponentMargin::XXL),
                TextComponentBuilder::builder()
                ->setText($item['iuran'])
                ->setWrap(true)
                ->setWeight(ComponentFontWeight::BOLD)
                ->setAlign('end')
                ->setSize(ComponentFontSize::SM),
            ]);
        }
        


        // $desc[] = TextComponentBuilder::builder()
        // ->setText($item['name'])
        // ->setWrap(true)
        // ->setWeight(ComponentFontWeight::REGULAR)
        // ->setSize(ComponentFontSize::SM);

        // $iuran[] = TextComponentBuilder::builder()
        // ->setText($item['iuran'])
        // ->setWrap(true)
        // ->setWeight(ComponentFontWeight::REGULAR)
        // ->setAlign('end')
        // ->setSize(ComponentFontSize::SM);

        return BoxComponentBuilder::builder()
        ->setLayout(ComponentLayout::VERTICAL)
        ->setSpacing(ComponentSpacing::XS)
        ->setContents($components);
        

    }

    private static function createItemFooterBlock($item)
    {

    }

    private static function createItemHeaderBlock($item)
    {
        $components = [];

        //judul
        $components[] = TextComponentBuilder::builder()
        ->setText('Iuran Kosan Pondok Mutiara 2')
        ->setWrap(true)
        ->setAlign('center')
        ->setWeight(ComponentFontWeight::BOLD)
        ->setSize(ComponentFontSize::XL);     

        return BoxComponentBuilder::builder()
        ->setLayout(ComponentLayout::VERTICAL)
        ->setSpacing(ComponentSpacing::SM)
        ->setContents($components);
    }

}
