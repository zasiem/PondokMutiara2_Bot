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

class FlexPenghuni
{
    private static $items = [
        '111' => [
            'photo' => 'https://unifiedinfotech.files.wordpress.com/2016/01/programmer_web_development_code_flat_design_vector_illustration_coder_html_website_concept_hands_typing_laptop_objects_desk_worplace.jpg?w=1108&h=737&crop=1',
            'name' => 'Erza Putra Albasori',
            'jurusan' => 'S1 Sistem Informasi',
            'asal' => 'Sidoarjo',
            'kamar' => 'Bawah',
        ],

        '112' => [
            'photo' => 'https://unifiedinfotech.files.wordpress.com/2016/01/programmer_web_development_code_flat_design_vector_illustration_coder_html_website_concept_hands_typing_laptop_objects_desk_worplace.jpg?w=1108&h=737&crop=1',
            'name' => 'Muhammad Naufal',
            'jurusan' => 'S1 Sistem Informasi',
            'asal' => 'Karawang',
            'kamar' => 'Bawah',
        ],

        '113' => [
            'photo' => 'https://unifiedinfotech.files.wordpress.com/2016/01/programmer_web_development_code_flat_design_vector_illustration_coder_html_website_concept_hands_typing_laptop_objects_desk_worplace.jpg?w=1108&h=737&crop=1',
            'name' => 'Mufti Alie S',
            'jurusan' => 'S1 Sistem Informasi',
            'asal' => 'Lumajang',
            'kamar' => 'Atas',
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
                self::createItemBubble(112),
                self::createItemBubble(113),
            ]));
    }

    private static function createItemBubble($itemId)
    {
        $item = self::$items[$itemId];
        return BubbleContainerBuilder::builder()
        // ->setStyle()
            ->setHero(self::createItemHeroBlock($item))
            ->setBody(self::createItemBodyBlock($item))
            ->setFooter(self::createItemFooterBlock($item));
    }

//gambar
    private static function createItemHeroBlock($item)
    {
        return ImageComponentBuilder::builder()
            ->setUrl($item['photo'])
            ->setSize(ComponentImageSize::FULL)
            ->setAspectRatio(ComponentImageAspectRatio::R1TO1)
            ->setAspectMode(ComponentImageAspectMode::COVER);
    }

//nama
    private static function createItemBodyBlock($item)
    {
        $components = [];

       $components[] = TextComponentBuilder::builder()
        ->setText($item['name'])
        ->setWrap(true)
        ->setAlign('center')
        ->setWeight(ComponentFontWeight::BOLD)
        ->setSize(ComponentFontSize::XL);

        return BoxComponentBuilder::builder()
            ->setLayout(ComponentLayout::HORIZONTAL)
            ->setSpacing(ComponentSpacing::SM)
            ->setContents($components);

    }

    private static function createItemFooterBlock($item)
    {
        $components = [];

        $components[] = TextComponentBuilder::builder()
        ->setText('Jurusan : '.$item['jurusan'])
        ->setWrap(true)
        ->setAlign('center')
        ->setSize(ComponentFontSize::MD);

        $components[] = TextComponentBuilder::builder()
        ->setText('Asal : '.$item['asal'])
        ->setWrap(true)
        ->setAlign('center')
        ->setSize(ComponentFontSize::MD);

        $components[] = TextComponentBuilder::builder()
        ->setText('Kamar : '.$item['kamar'])
        ->setWrap(true)
        ->setAlign('center')
        ->setSize(ComponentFontSize::MD);

        

        return BoxComponentBuilder::builder()
            ->setLayout(ComponentLayout::VERTICAL)
            ->setSpacing(ComponentSpacing::SM)
            ->setContents($components);
    }

}
