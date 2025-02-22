<?php
/**
 * @author Lajos Molnar <lajax.m@gmail.com>
 * @portedToBootstrap5 Cristian Garcia Copete <cristian@demondog.es>
 */

use yii\db\Migration;

class m220905_091157_translate_manager extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        // LANGUAGE
        $checkLanguageExist = Yii::$app->db->schema->getTableSchema('language');
        if (!isset($checkLanguageExist)) {
            $this->createTable('{{%language}}', [
                'language_id' => $this->string(5)->notNull(),
                'language' => $this->string(3)->notNull(),
                'country' => $this->string(3)->notNull(),
                'name' => $this->string(32)->notNull(),
                'name_ascii' => $this->string(32)->notNull(),
                'status' => $this->smallInteger(6)->notNull(),
            ], $tableOptions);
            $this->addPrimaryKey('pk_on_language', '{{%language}}', ['language_id']);
        }

        // LANGUAGE FORCE TRANSLATION
        $checkLanguageForceTranslationExist = Yii::$app->db->schema->getTableSchema('language_force_translation');
        if (!isset($checkLanguageForceTranslationExist)) {
            $this->createTable('{{%language_force_translation}}', [
                'id' => $this->primaryKey(11),
                'value' => $this->text()->notNull(),
            ], $tableOptions);
        }

        // LANGUAGE SOURCE
        $checkLanguageSourceExist = Yii::$app->db->schema->getTableSchema('language_source');
        if (!isset($checkLanguageSourceExist)) {
            $this->createTable('{{%language_source}}', [
                'id' => $this->primaryKey(11),
                'category' => $this->string(32)->null()->defaultValue(null),
                'message' => $this->text()->null()->defaultValue(null),
            ], $tableOptions);
        }

        // LANGUAGE TRANSLATE
        $checkLanguageTranslateExist = Yii::$app->db->schema->getTableSchema('language_translate');
        if (!isset($checkLanguageTranslateExist)) {
            $this->createTable('{{%language_translate}}', [
                'id' => $this->integer(11)->notNull(),
                'language' => $this->string(5)->notNull(),
                'translation' => $this->text()->null()->defaultValue(null),
            ], $tableOptions);
            $this->createIndex('language_translate_idx_language', '{{%language_translate}}', ['language'], false);
            $this->addPrimaryKey('pk_on_language_translate', '{{%language_translate}}', ['id', 'language']);

            // FOREIGN KEYS
            $this->addForeignKey(
                'fk_language_translate_id',
                '{{%language_translate}}', 'id',
                '{{%language_source}}', 'id',
                'CASCADE', 'CASCADE'
            );
            $this->addForeignKey(
                'fk_language_translate_language',
                '{{%language_translate}}', 'language',
                '{{%language}}', 'language_id',
                'CASCADE', 'CASCADE'
            );
        }

        // LANGUAGE DATA
        $this->batchInsert('{{%language}}', ["language_id", "language", "country", "name", "name_ascii", "status"], [
            [
                'language_id' => 'af-ZA',
                'language' => 'af',
                'country' => 'za',
                'name' => 'Afrikaans',
                'name_ascii' => 'Afrikaans',
                'status' => '0',
            ],
            [
                'language_id' => 'ar-AR',
                'language' => 'ar',
                'country' => 'ar',
                'name' => '‏العربية‏',
                'name_ascii' => 'Arabic',
                'status' => '0',
            ],
            [
                'language_id' => 'az-AZ',
                'language' => 'az',
                'country' => 'az',
                'name' => 'Azərbaycan dili',
                'name_ascii' => 'Azerbaijani',
                'status' => '0',
            ],
            [
                'language_id' => 'be-BY',
                'language' => 'be',
                'country' => 'by',
                'name' => 'Беларуская',
                'name_ascii' => 'Belarusian',
                'status' => '0',
            ],
            [
                'language_id' => 'bg-BG',
                'language' => 'bg',
                'country' => 'bg',
                'name' => 'Български',
                'name_ascii' => 'Bulgarian',
                'status' => '0',
            ],
            [
                'language_id' => 'bn-IN',
                'language' => 'bn',
                'country' => 'in',
                'name' => 'বাংলা',
                'name_ascii' => 'Bengali',
                'status' => '0',
            ],
            [
                'language_id' => 'bs-BA',
                'language' => 'bs',
                'country' => 'ba',
                'name' => 'Bosanski',
                'name_ascii' => 'Bosnian',
                'status' => '0',
            ],
            [
                'language_id' => 'ca-ES',
                'language' => 'ca',
                'country' => 'es',
                'name' => 'Català',
                'name_ascii' => 'Catalan',
                'status' => '0',
            ],
            [
                'language_id' => 'cs-CZ',
                'language' => 'cs',
                'country' => 'cz',
                'name' => 'Čeština',
                'name_ascii' => 'Czech',
                'status' => '0',
            ],
            [
                'language_id' => 'cy-GB',
                'language' => 'cy',
                'country' => 'gb',
                'name' => 'Cymraeg',
                'name_ascii' => 'Welsh',
                'status' => '0',
            ],
            [
                'language_id' => 'da-DK',
                'language' => 'da',
                'country' => 'dk',
                'name' => 'Dansk',
                'name_ascii' => 'Danish',
                'status' => '0',
            ],
            [
                'language_id' => 'de-DE',
                'language' => 'de',
                'country' => 'de',
                'name' => 'Deutsch',
                'name_ascii' => 'German',
                'status' => '0',
            ],
            [
                'language_id' => 'el-GR',
                'language' => 'el',
                'country' => 'gr',
                'name' => 'Ελληνικά',
                'name_ascii' => 'Greek',
                'status' => '0',
            ],
            [
                'language_id' => 'en-GB',
                'language' => 'en',
                'country' => 'gb',
                'name' => 'English',
                'name_ascii' => 'English (UK)',
                'status' => '1',
            ],
            [
                'language_id' => 'en-PI',
                'language' => 'en',
                'country' => 'pi',
                'name' => 'English (Pirate)',
                'name_ascii' => 'English (Pirate)',
                'status' => '0',
            ],
            [
                'language_id' => 'en-UD',
                'language' => 'en',
                'country' => 'ud',
                'name' => 'English (Upside Down)',
                'name_ascii' => 'English (Upside Down)',
                'status' => '0',
            ],
            [
                'language_id' => 'en-US',
                'language' => 'en',
                'country' => 'us',
                'name' => 'English (US)',
                'name_ascii' => 'English (US)',
                'status' => '0',
            ],
            [
                'language_id' => 'eo-EO',
                'language' => 'eo',
                'country' => 'eo',
                'name' => 'Esperanto',
                'name_ascii' => 'Esperanto',
                'status' => '0',
            ],
            [
                'language_id' => 'es-ES',
                'language' => 'es',
                'country' => 'es',
                'name' => 'Español',
                'name_ascii' => 'Spanish (Spain)',
                'status' => '1',
            ],
            [
                'language_id' => 'es-LA',
                'language' => 'es',
                'country' => 'la',
                'name' => 'Español',
                'name_ascii' => 'Spanish',
                'status' => '0',
            ],
            [
                'language_id' => 'et-EE',
                'language' => 'et',
                'country' => 'ee',
                'name' => 'Eesti',
                'name_ascii' => 'Estonian',
                'status' => '0',
            ],
            [
                'language_id' => 'eu-ES',
                'language' => 'eu',
                'country' => 'es',
                'name' => 'Euskara',
                'name_ascii' => 'Basque',
                'status' => '0',
            ],
            [
                'language_id' => 'fa-IR',
                'language' => 'fa',
                'country' => 'ir',
                'name' => '‏فارسی‏',
                'name_ascii' => 'Persian',
                'status' => '0',
            ],
            [
                'language_id' => 'fb-LT',
                'language' => 'fb',
                'country' => 'lt',
                'name' => 'Leet Speak',
                'name_ascii' => 'Leet Speak',
                'status' => '0',
            ],
            [
                'language_id' => 'fi-FI',
                'language' => 'fi',
                'country' => 'fi',
                'name' => 'Suomi',
                'name_ascii' => 'Finnish',
                'status' => '0',
            ],
            [
                'language_id' => 'fo-FO',
                'language' => 'fo',
                'country' => 'fo',
                'name' => 'Føroyskt',
                'name_ascii' => 'Faroese',
                'status' => '0',
            ],
            [
                'language_id' => 'fr-CA',
                'language' => 'fr',
                'country' => 'ca',
                'name' => 'Français (Canada)',
                'name_ascii' => 'French (Canada)',
                'status' => '0',
            ],
            [
                'language_id' => 'fr-FR',
                'language' => 'fr',
                'country' => 'fr',
                'name' => 'Français (France)',
                'name_ascii' => 'French (France)',
                'status' => '0',
            ],
            [
                'language_id' => 'fy-NL',
                'language' => 'fy',
                'country' => 'nl',
                'name' => 'Frysk',
                'name_ascii' => 'Frisian',
                'status' => '0',
            ],
            [
                'language_id' => 'ga-IE',
                'language' => 'ga',
                'country' => 'ie',
                'name' => 'Gaeilge',
                'name_ascii' => 'Irish',
                'status' => '0',
            ],
            [
                'language_id' => 'gl-ES',
                'language' => 'gl',
                'country' => 'es',
                'name' => 'Galego',
                'name_ascii' => 'Galician',
                'status' => '0',
            ],
            [
                'language_id' => 'he-IL',
                'language' => 'he',
                'country' => 'il',
                'name' => '‏עברית‏',
                'name_ascii' => 'Hebrew',
                'status' => '0',
            ],
            [
                'language_id' => 'hi-IN',
                'language' => 'hi',
                'country' => 'in',
                'name' => 'हिन्दी',
                'name_ascii' => 'Hindi',
                'status' => '0',
            ],
            [
                'language_id' => 'hr-HR',
                'language' => 'hr',
                'country' => 'hr',
                'name' => 'Hrvatski',
                'name_ascii' => 'Croatian',
                'status' => '0',
            ],
            [
                'language_id' => 'hu-HU',
                'language' => 'hu',
                'country' => 'hu',
                'name' => 'Magyar',
                'name_ascii' => 'Hungarian',
                'status' => '0',
            ],
            [
                'language_id' => 'hy-AM',
                'language' => 'hy',
                'country' => 'am',
                'name' => 'Հայերեն',
                'name_ascii' => 'Armenian',
                'status' => '0',
            ],
            [
                'language_id' => 'id-ID',
                'language' => 'id',
                'country' => 'id',
                'name' => 'Bahasa Indonesia',
                'name_ascii' => 'Indonesian',
                'status' => '0',
            ],
            [
                'language_id' => 'is-IS',
                'language' => 'is',
                'country' => 'is',
                'name' => 'Íslenska',
                'name_ascii' => 'Icelandic',
                'status' => '0',
            ],
            [
                'language_id' => 'it-IT',
                'language' => 'it',
                'country' => 'it',
                'name' => 'Italiano',
                'name_ascii' => 'Italian',
                'status' => '0',
            ],
            [
                'language_id' => 'ja-JP',
                'language' => 'ja',
                'country' => 'jp',
                'name' => '日本語',
                'name_ascii' => 'Japanese',
                'status' => '0',
            ],
            [
                'language_id' => 'ka-GE',
                'language' => 'ka',
                'country' => 'ge',
                'name' => 'ქართული',
                'name_ascii' => 'Georgian',
                'status' => '0',
            ],
            [
                'language_id' => 'km-KH',
                'language' => 'km',
                'country' => 'kh',
                'name' => 'ភាសាខ្មែរ',
                'name_ascii' => 'Khmer',
                'status' => '0',
            ],
            [
                'language_id' => 'ko-KR',
                'language' => 'ko',
                'country' => 'kr',
                'name' => '한국어',
                'name_ascii' => 'Korean',
                'status' => '0',
            ],
            [
                'language_id' => 'ku-TR',
                'language' => 'ku',
                'country' => 'tr',
                'name' => 'Kurdî',
                'name_ascii' => 'Kurdish',
                'status' => '0',
            ],
            [
                'language_id' => 'la-VA',
                'language' => 'la',
                'country' => 'va',
                'name' => 'lingua latina',
                'name_ascii' => 'Latin',
                'status' => '0',
            ],
            [
                'language_id' => 'lt-LT',
                'language' => 'lt',
                'country' => 'lt',
                'name' => 'Lietuvių',
                'name_ascii' => 'Lithuanian',
                'status' => '0',
            ],
            [
                'language_id' => 'lv-LV',
                'language' => 'lv',
                'country' => 'lv',
                'name' => 'Latviešu',
                'name_ascii' => 'Latvian',
                'status' => '0',
            ],
            [
                'language_id' => 'mk-MK',
                'language' => 'mk',
                'country' => 'mk',
                'name' => 'Македонски',
                'name_ascii' => 'Macedonian',
                'status' => '0',
            ],
            [
                'language_id' => 'ml-IN',
                'language' => 'ml',
                'country' => 'in',
                'name' => 'മലയാളം',
                'name_ascii' => 'Malayalam',
                'status' => '0',
            ],
            [
                'language_id' => 'ms-MY',
                'language' => 'ms',
                'country' => 'my',
                'name' => 'Bahasa Melayu',
                'name_ascii' => 'Malay',
                'status' => '0',
            ],
            [
                'language_id' => 'nb-NO',
                'language' => 'nb',
                'country' => 'no',
                'name' => 'Norsk (bokmål)',
                'name_ascii' => 'Norwegian (bokmal)',
                'status' => '0',
            ],
            [
                'language_id' => 'ne-NP',
                'language' => 'ne',
                'country' => 'np',
                'name' => 'नेपाली',
                'name_ascii' => 'Nepali',
                'status' => '0',
            ],
            [
                'language_id' => 'nl-NL',
                'language' => 'nl',
                'country' => 'nl',
                'name' => 'Nederlands',
                'name_ascii' => 'Dutch',
                'status' => '0',
            ],
            [
                'language_id' => 'nn-NO',
                'language' => 'nn',
                'country' => 'no',
                'name' => 'Norsk (nynorsk)',
                'name_ascii' => 'Norwegian (nynorsk)',
                'status' => '0',
            ],
            [
                'language_id' => 'pa-IN',
                'language' => 'pa',
                'country' => 'in',
                'name' => 'ਪੰਜਾਬੀ',
                'name_ascii' => 'Punjabi',
                'status' => '0',
            ],
            [
                'language_id' => 'pl-PL',
                'language' => 'pl',
                'country' => 'pl',
                'name' => 'Polski',
                'name_ascii' => 'Polish',
                'status' => '0',
            ],
            [
                'language_id' => 'ps-AF',
                'language' => 'ps',
                'country' => 'af',
                'name' => '‏پښتو‏',
                'name_ascii' => 'Pashto',
                'status' => '0',
            ],
            [
                'language_id' => 'pt-BR',
                'language' => 'pt',
                'country' => 'br',
                'name' => 'Português (Brasil)',
                'name_ascii' => 'Portuguese (Brazil)',
                'status' => '0',
            ],
            [
                'language_id' => 'pt-PT',
                'language' => 'pt',
                'country' => 'pt',
                'name' => 'Português (Portugal)',
                'name_ascii' => 'Portuguese (Portugal)',
                'status' => '0',
            ],
            [
                'language_id' => 'ro-RO',
                'language' => 'ro',
                'country' => 'ro',
                'name' => 'Română',
                'name_ascii' => 'Romanian',
                'status' => '0',
            ],
            [
                'language_id' => 'ru-RU',
                'language' => 'ru',
                'country' => 'ru',
                'name' => 'Русский',
                'name_ascii' => 'Russian',
                'status' => '0',
            ],
            [
                'language_id' => 'sk-SK',
                'language' => 'sk',
                'country' => 'sk',
                'name' => 'Slovenčina',
                'name_ascii' => 'Slovak',
                'status' => '0',
            ],
            [
                'language_id' => 'sl-SI',
                'language' => 'sl',
                'country' => 'si',
                'name' => 'Slovenščina',
                'name_ascii' => 'Slovenian',
                'status' => '0',
            ],
            [
                'language_id' => 'sq-AL',
                'language' => 'sq',
                'country' => 'al',
                'name' => 'Shqip',
                'name_ascii' => 'Albanian',
                'status' => '0',
            ],
            [
                'language_id' => 'sr-RS',
                'language' => 'sr',
                'country' => 'rs',
                'name' => 'Српски',
                'name_ascii' => 'Serbian',
                'status' => '0',
            ],
            [
                'language_id' => 'sv-SE',
                'language' => 'sv',
                'country' => 'se',
                'name' => 'Svenska',
                'name_ascii' => 'Swedish',
                'status' => '1',
            ],
            [
                'language_id' => 'sw-KE',
                'language' => 'sw',
                'country' => 'ke',
                'name' => 'Kiswahili',
                'name_ascii' => 'Swahili',
                'status' => '0',
            ],
            [
                'language_id' => 'ta-IN',
                'language' => 'ta',
                'country' => 'in',
                'name' => 'தமிழ்',
                'name_ascii' => 'Tamil',
                'status' => '0',
            ],
            [
                'language_id' => 'te-IN',
                'language' => 'te',
                'country' => 'in',
                'name' => 'తెలుగు',
                'name_ascii' => 'Telugu',
                'status' => '0',
            ],
            [
                'language_id' => 'th-TH',
                'language' => 'th',
                'country' => 'th',
                'name' => 'ภาษาไทย',
                'name_ascii' => 'Thai',
                'status' => '0',
            ],
            [
                'language_id' => 'tl-PH',
                'language' => 'tl',
                'country' => 'ph',
                'name' => 'Filipino',
                'name_ascii' => 'Filipino',
                'status' => '0',
            ],
            [
                'language_id' => 'tr-TR',
                'language' => 'tr',
                'country' => 'tr',
                'name' => 'Türkçe',
                'name_ascii' => 'Turkish',
                'status' => '0',
            ],
            [
                'language_id' => 'uk-UA',
                'language' => 'uk',
                'country' => 'ua',
                'name' => 'Українська',
                'name_ascii' => 'Ukrainian',
                'status' => '0',
            ],
            [
                'language_id' => 'vi-VN',
                'language' => 'vi',
                'country' => 'vn',
                'name' => 'Tiếng Việt',
                'name_ascii' => 'Vietnamese',
                'status' => '0',
            ],
            [
                'language_id' => 'xx-XX',
                'language' => 'xx',
                'country' => 'xx',
                'name' => 'Fejlesztő',
                'name_ascii' => 'Developer',
                'status' => '0',
            ],
            [
                'language_id' => 'zh-CN',
                'language' => 'zh',
                'country' => 'cn',
                'name' => '中文(简体)',
                'name_ascii' => 'Simplified Chinese (China)',
                'status' => '0',
            ],
            [
                'language_id' => 'zh-HK',
                'language' => 'zh',
                'country' => 'hk',
                'name' => '中文(香港)',
                'name_ascii' => 'Traditional Chinese (Hong Kong)',
                'status' => '0',
            ],
            [
                'language_id' => 'zh-TW',
                'language' => 'zh',
                'country' => 'tw',
                'name' => '中文(台灣)',
                'name_ascii' => 'Traditional Chinese (Taiwan)',
                'status' => '0',
            ],
        ]);

    }

    public function safeDown()
    {
        $this->dropPrimaryKey('pk_on_language', '{{%language}}');
        $this->dropForeignKey('fk_language_translate_id', '{{%language_translate}}');
        $this->dropForeignKey('fk_language_translate_language', '{{%language_translate}}');
        $this->dropPrimaryKey('pk_on_language_translate', '{{%language_translate}}');

        $this->dropTable('{{%language}}');
        $this->dropTable('{{%language_force_translation}}');
        $this->dropTable('{{%language_source}}');
        $this->dropTable('{{%language_translate}}');
    }

}