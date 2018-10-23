<?php

use yii\db\Migration;

/**
 * Insert most of the circulating currencies.
 */
class m181018_195533_basecurrencies extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert(
            \luya\estore\models\Currency::tableName(),
            ['iso', 'name', 'value'],
            [
                [
                    'iso' => 'AFN',
                    'name' => 'Afghan Afghani',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ALL',
                    'name' => 'Albanian Lek',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'DZD',
                    'name' => 'Algerian Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AOA',
                    'name' => 'Angolan Kwanza',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ARS',
                    'name' => 'Argentine Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AMD',
                    'name' => 'Armenian Dram',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AWG',
                    'name' => 'Aruban Florin',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AUD',
                    'name' => 'Australian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AZN',
                    'name' => 'Azerbaijani Manat',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AZM',
                    'name' => 'Azerbaijani Manat (1993–2006)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BSD',
                    'name' => 'Bahamian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BHD',
                    'name' => 'Bahraini Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BDT',
                    'name' => 'Bangladeshi Taka',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BBD',
                    'name' => 'Barbadian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BYR',
                    'name' => 'Belarusian Ruble',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BZD',
                    'name' => 'Belize Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BMD',
                    'name' => 'Bermudan Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BTN',
                    'name' => 'Bhutanese Ngultrum',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BOB',
                    'name' => 'Bolivian Boliviano',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BAM',
                    'name' => 'Bosnia-Herzegovina Convertible Mark',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BWP',
                    'name' => 'Botswanan Pula',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BRL',
                    'name' => 'Brazilian Real',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GBP',
                    'name' => 'British Pound Sterling',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BND',
                    'name' => 'Brunei Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BGN',
                    'name' => 'Bulgarian Lev',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BUK',
                    'name' => 'Burmese Kyat',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'BIF',
                    'name' => 'Burundian Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'XOF',
                    'name' => 'CFA Franc BCEAO',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'XPF',
                    'name' => 'CFP Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KHR',
                    'name' => 'Cambodian Riel',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CAD',
                    'name' => 'Canadian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CVE',
                    'name' => 'Cape Verdean Escudo',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KYD',
                    'name' => 'Cayman Islands Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CLP',
                    'name' => 'Chilean Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CNY',
                    'name' => 'Chinese Yuan',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'COP',
                    'name' => 'Colombian Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KMF',
                    'name' => 'Comorian Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CDF',
                    'name' => 'Congolese Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CRC',
                    'name' => 'Costa Rican Colón',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'HRK',
                    'name' => 'Croatian Kuna',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CUP',
                    'name' => 'Cuban Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CZK',
                    'name' => 'Czech Republic Koruna',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'DKK',
                    'name' => 'Danish Krone',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'DJF',
                    'name' => 'Djiboutian Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'DOP',
                    'name' => 'Dominican Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'XCD',
                    'name' => 'East Caribbean Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'EGP',
                    'name' => 'Egyptian Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GQE',
                    'name' => 'Equatorial Guinean Ekwele',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ERN',
                    'name' => 'Eritrean Nakfa',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'EEK',
                    'name' => 'Estonian Kroon',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ETB',
                    'name' => 'Ethiopian Birr',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'EUR',
                    'name' => 'Euro',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'FKP',
                    'name' => 'Falkland Islands Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'FJD',
                    'name' => 'Fijian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GMD',
                    'name' => 'Gambian Dalasi',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GEK',
                    'name' => 'Georgian Kupon Larit',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GEL',
                    'name' => 'Georgian Lari',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GHS',
                    'name' => 'Ghanaian Cedi',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GIP',
                    'name' => 'Gibraltar Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GTQ',
                    'name' => 'Guatemalan Quetzal',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GNF',
                    'name' => 'Guinean Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'GYD',
                    'name' => 'Guyanaese Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'HTG',
                    'name' => 'Haitian Gourde',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'HNL',
                    'name' => 'Honduran Lempira',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'HKD',
                    'name' => 'Hong Kong Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'HUF',
                    'name' => 'Hungarian Forint',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ISK',
                    'name' => 'Icelandic Króna',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'INR',
                    'name' => 'Indian Rupee',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'IDR',
                    'name' => 'Indonesian Rupiah',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'IRR',
                    'name' => 'Iranian Rial',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'IQD',
                    'name' => 'Iraqi Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ILS',
                    'name' => 'Israeli New Sheqel',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'JMD',
                    'name' => 'Jamaican Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'JPY',
                    'name' => 'Japanese Yen',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'JOD',
                    'name' => 'Jordanian Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KZT',
                    'name' => 'Kazakhstani Tenge',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KES',
                    'name' => 'Kenyan Shilling',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KWD',
                    'name' => 'Kuwaiti Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KGS',
                    'name' => 'Kyrgystani Som',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LAK',
                    'name' => 'Laotian Kip',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LVL',
                    'name' => 'Latvian Lats',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LBP',
                    'name' => 'Lebanese Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LSL',
                    'name' => 'Lesotho Loti',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LRD',
                    'name' => 'Liberian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LYD',
                    'name' => 'Libyan Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LTL',
                    'name' => 'Lithuanian Litas',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MOP',
                    'name' => 'Macanese Pataca',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MKD',
                    'name' => 'Macedonian Denar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MGA',
                    'name' => 'Malagasy Ariary',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MWK',
                    'name' => 'Malawian Kwacha',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MYR',
                    'name' => 'Malaysian Ringgit',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MVR',
                    'name' => 'Maldivian Rufiyaa',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MRO',
                    'name' => 'Mauritanian Ouguiya',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MUR',
                    'name' => 'Mauritian Rupee',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MXN',
                    'name' => 'Mexican Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MDL',
                    'name' => 'Moldovan Leu',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MNT',
                    'name' => 'Mongolian Tugrik',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MAD',
                    'name' => 'Moroccan Dirham',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MZN',
                    'name' => 'Mozambican Metical',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'MMK',
                    'name' => 'Myanmar Kyat',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'NAD',
                    'name' => 'Namibian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'NPR',
                    'name' => 'Nepalese Rupee',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ANG',
                    'name' => 'Netherlands Antillean Guilder',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TWD',
                    'name' => 'New Taiwan Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'NZD',
                    'name' => 'New Zealand Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'NIC',
                    'name' => 'Nicaraguan Córdoba (1988–1991)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'NGN',
                    'name' => 'Nigerian Naira',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KPW',
                    'name' => 'North Korean Won',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'NOK',
                    'name' => 'Norwegian Krone',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'OMR',
                    'name' => 'Omani Rial',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PKR',
                    'name' => 'Pakistani Rupee',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PAB',
                    'name' => 'Panamanian Balboa',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PGK',
                    'name' => 'Papua New Guinean Kina',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PYG',
                    'name' => 'Paraguayan Guarani',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PEN',
                    'name' => 'Peruvian Nuevo Sol',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PHP',
                    'name' => 'Philippine Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'PLN',
                    'name' => 'Polish Zloty',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'QAR',
                    'name' => 'Qatari Rial',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'RHD',
                    'name' => 'Rhodesian Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'RON',
                    'name' => 'Romanian Leu',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ROL',
                    'name' => 'Romanian Leu (1952–2006)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'RUB',
                    'name' => 'Russian Ruble',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'RWF',
                    'name' => 'Rwandan Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SHP',
                    'name' => 'Saint Helena Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SVC',
                    'name' => 'Salvadoran Colón',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'WST',
                    'name' => 'Samoan Tala',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SAR',
                    'name' => 'Saudi Riyal',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'RSD',
                    'name' => 'Serbian Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SCR',
                    'name' => 'Seychellois Rupee',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SLL',
                    'name' => 'Sierra Leonean Leone',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SGD',
                    'name' => 'Singapore Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SKK',
                    'name' => 'Slovak Koruna',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SBD',
                    'name' => 'Solomon Islands Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SOS',
                    'name' => 'Somali Shilling',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ZAR',
                    'name' => 'South African Rand',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'KRW',
                    'name' => 'South Korean Won',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'LKR',
                    'name' => 'Sri Lankan Rupee',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SDG',
                    'name' => 'Sudanese Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SRD',
                    'name' => 'Surinamese Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SZL',
                    'name' => 'Swazi Lilangeni',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SEK',
                    'name' => 'Swedish Krona',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CHF',
                    'name' => 'Swiss Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'SYP',
                    'name' => 'Syrian Pound',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'STD',
                    'name' => 'São Tomé and Príncipe Dobra',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TJS',
                    'name' => 'Tajikistani Somoni',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TZS',
                    'name' => 'Tanzanian Shilling',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'THB',
                    'name' => 'Thai Baht',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TOP',
                    'name' => 'Tongan Pa´anga',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TTD',
                    'name' => 'Trinidad and Tobago Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TND',
                    'name' => 'Tunisian Dinar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TRY',
                    'name' => 'Turkish Lira',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TRL',
                    'name' => 'Turkish Lira (1922–2005)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'TMM',
                    'name' => 'Turkmenistani Manat (1993–2009)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'USD',
                    'name' => 'US Dollar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'UGX',
                    'name' => 'Ugandan Shilling',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'UAH',
                    'name' => 'Ukrainian Hryvnia',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'AED',
                    'name' => 'United Arab Emirates Dirham',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'UYU',
                    'name' => 'Uruguayan Peso',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'UZS',
                    'name' => 'Uzbekistan Som',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'VUV',
                    'name' => 'Vanuatu Vatu',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'VEF',
                    'name' => 'Venezuelan Bolívar',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'VEB',
                    'name' => 'Venezuelan Bolívar (1871–2008)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'VND',
                    'name' => 'Vietnamese Dong',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CHE',
                    'name' => 'WIR Euro',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'CHW',
                    'name' => 'WIR Franc',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'YER',
                    'name' => 'Yemeni Rial',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ZMK',
                    'name' => 'Zambian Kwacha (1968–2012)',
                    'value' => 1.0,
                ],
                [
                    'iso' => 'ZWD',
                    'name' => 'Zimbabwean Dollar (1980–2008)',
                    'value' => 1.0,
                ],
            ]
        );

        $this->update(\luya\estore\models\Currency::tableName(), ['is_base' => true], ['iso' => 'EUR']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(luya\estore\models\Currency::tableName());

        return true;
    }
}
