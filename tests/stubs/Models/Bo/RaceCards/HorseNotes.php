<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class HorseNotes extends \Tests\Stubs\Models\HorseNotes
{

    /**
     * @param string $dateBegin
     * @param string $dateEnd
     *
     * @return array
     */
    public function getStableToursDatabase($dateBegin, $dateEnd)
    {
        return array(
            0 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'race_instance_uid' => 674239,
                        'race_datetime' => 'Apr 25 2017  4:55PM',
                        'race_status_code' => 'O',
                        'course_style_name' => 'Punchestown',
                        'course_name' => 'PUNCHESTOWN',
                        'course_uid' => 195,
                        'horse_uid' => 847824,
                        'horse_style_name' => 'Miles To Memphis',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'Disappointing after winning on his seasonal debut last year but has had a good break and is moving as well as he�s ever done on the gallops. He�ll be handicap hurdling over 2m4f or thereabouts. - 20/10/2015.',
                        'trainer_uid' => 12900,
                        'trainer_style_name' => 'Mrs Denise Foster',
                    )
                ),
            1 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'race_instance_uid' => 674239,
                        'race_datetime' => 'Apr 25 2017  4:55PM',
                        'race_status_code' => 'O',
                        'course_style_name' => 'Punchestown',
                        'course_name' => 'PUNCHESTOWN',
                        'course_uid' => 195,
                        'horse_uid' => 847824,
                        'horse_style_name' => 'Miles To Memphis',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'He went down as one of our big disappointments last season. He was a very good bumper horse and did the job well on his hurdling debut at Fontwell, but he didn�t go on. He�s had a long break, we�ve tinkered with a few things and he�s moving better than he has ever done. He�ll go down the handicap route over hurdles. - 04/11/2015.',
                        'trainer_uid' => 12900,
                        'trainer_style_name' => 'Mrs Denise Foster',
                    )
                ),
            2 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'race_instance_uid' => 674239,
                        'race_datetime' => 'Apr 25 2017  4:55PM',
                        'race_status_code' => 'O',
                        'course_style_name' => 'Punchestown',
                        'course_name' => 'PUNCHESTOWN',
                        'course_uid' => 195,
                        'horse_uid' => 901793,
                        'horse_style_name' => 'Clara Sorrento',
                        'horse_country_origin_code' => 'FR',
                        'notes' => 'I like him. We will go back and try and win a bumper with him and he jumps well so he is not one to write off. I don�t think he ran his race at Tipperary - 27/10/2016.',
                        'trainer_uid' => 4446,
                        'trainer_style_name' => 'Noel Meade',
                    )
                ),
        );
    }

    /**
     * @param string
     *
     * @return array
     */
    public function getStableToursDatabaseByHorseName($searchTerm)
    {
        return array(
            0 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'horse_uid' => 726035,
                        'horse_style_name' => 'Realt Mor',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'A former Grade 1 winner who�s had his fair share of problems. There�s a veterans� chase at Aintree in a few weeks and we are going to aim him at that. I still think he�ll pay his way this winter. - 19/10/2016',
                        'trainer_uid' => 18145,
                        'trainer_style_name' => 'Gordon Elliott',
                        'race_instance_uid' => null,
                        'race_datetime' => null,
                        'race_status_code' => null,
                        'course_style_name' => null,
                        'course_name' => null,
                        'course_uid' => null,
                    )
                ),
            1 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'horse_uid' => 855936,
                        'horse_style_name' => 'Realtra',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'She ran poorly both times in Dubai and I can�t really explain why but she�s training really well and will run in the fillies� and mares� race on Good Friday. If I could forget Dubai she�d have a big chance at Lingfield. - 11/04/2017',
                        'trainer_uid' => 24890,
                        'trainer_style_name' => 'Roger Varian',
                        'race_instance_uid' => 598352,
                        'race_datetime' => 'Apr 16 2014  1:55PM',
                        'race_status_code' => 'R',
                        'course_style_name' => 'Beverley',
                        'course_name' => 'BEVERLEY',
                        'course_uid' => 6,
                    )
                ),
        );
    }

    /**
     * @param string $searchTerm
     *
     * @return array
     */
    public function getStableToursDatabaseByTrainerName($searchTerm)
    {
        return array(
            0 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'horse_uid' => 791511,
                        'horse_style_name' => 'Appealing',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'This half-sister to Cornwallis Stakes winner Electric Waves could be very interesting. Last year she finished a head second to Apocathecary on her debut before winning with ease over a decent opponent at Wolverhampton in January. She returned to action, at Kempton, last weekend when down the field in a mile conditions race. She is better than that hence entries in the German and English Guineas. Our aim with her this term is to get some Black Type - Weekender Apr 11 2012',
                        'trainer_uid' => 13924,
                        'trainer_style_name' => 'Patrick Gallagher',
                        'race_instance_uid' => null,
                        'race_datetime' => null,
                        'race_status_code' => null,
                        'course_style_name' => null,
                        'course_name' => null,
                        'course_uid' => null,
                    )
                ),
            1 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'horse_uid' => 901699,
                        'horse_style_name' => 'September Stars',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'First time out you could see all the way down the back and round the top bend she was pitching in the ground, and she went on three out and just paddled the last half-furlong and got caught. But we still think she\'s a nice filly and I\'ll find a 1m2f maiden for her. 26/04/2016',
                        'trainer_uid' => 13924,
                        'trainer_style_name' => 'Patrick Gallagher',
                        'race_instance_uid' => null,
                        'race_datetime' => null,
                        'race_status_code' => null,
                        'course_style_name' => null,
                        'course_name' => null,
                        'course_uid' => null,
                    )
                ),
            2 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'horse_uid' => 901699,
                        'horse_style_name' => 'September Stars',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'She�s a really genuine filly who flourished this summer. She opened her account in a Windsor handicap in July and won with such authority that I ran her back there with a 6lb penalty when she was even more impressive. I stepped her up to Group 3 company for the Atalanta Stakes at Sandown last month but things didn�t work out for her there. My job will be to get some black type for her this autumn and she could run in the Rosemary Stakes at Newmarket on Friday - 21/09/2016.',
                        'trainer_uid' => 13924,
                        'trainer_style_name' => 'Patrick Gallagher',
                        'race_instance_uid' => null,
                        'race_datetime' => null,
                        'race_status_code' => null,
                        'course_style_name' => null,
                        'course_name' => null,
                        'course_uid' => null,
                    )
                ),
            3 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'horse_uid' => 1022959,
                        'horse_style_name' => 'Tiburtina',
                        'horse_country_origin_code' => 'IRE',
                        'notes' => 'She ran really well to finish fifth, beaten just a couple of lengths, on her debut at Kempton this month. I know Ralph Beckett is very sweet on the winner, Sibilance, and other trainers said nice things about their fillies, so I think it was a strong maiden and the form will work out. She travelled well but hung fire and ran green at the end. She�ll improve a lot for that and is ready to go again. We�ll find her a nice 6f maiden. - 22/06/2016.',
                        'trainer_uid' => 13924,
                        'trainer_style_name' => 'Patrick Gallagher',
                        'race_instance_uid' => null,
                        'race_datetime' => null,
                        'race_status_code' => null,
                        'course_style_name' => null,
                        'course_name' => null,
                        'course_uid' => null,
                    )
                ),
        );
    }
}
