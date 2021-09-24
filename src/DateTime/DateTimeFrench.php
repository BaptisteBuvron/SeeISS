<?php

namespace App\DateTime;

class DateTimeFrench extends \DateTime{
    public function format($format='j M Y'): array|string
    {
        $days_full = array(
            'Monday'    => 'Lundi',
            'Tuesday'   => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday'  => 'Jeudi',
            'Friday'    => 'Vendredi',
            'Saturday'  => 'Samedi',
            'Sunday'    => 'Dimanche'
        );
        $days_small = array(
            'Mon' => 'Lun',
            'Tue' => 'Mar',
            'Wed' => 'Mer',
            'Thu' => 'Jeu',
            'Fri' => 'Ven',
            'Sat' => 'Sam',
            'Sun' => 'Dim'
        );
        $months_full = array(
            'January'   => 'Janvier',
            'February'  => 'Février',
            'March'     => 'Mars',
            'April'     => 'Avril',
            'May'       => 'Mai',
            'June'      => 'Juin',
            'July'      => 'Juillet',
            'August'    => 'Août',
            'September' => 'Septembre',
            'October'   => 'Octobre',
            'November'  => 'Novembre',
            'December'  => 'Décembre'
        );
        $months_small = array(
            'Feb' => 'Fév',
            'Apr' => 'Avr',
            'May' => 'Mai',
            'Jun' => 'Juin',
            'Jul' => 'Juil',
            'Aug' => 'Août',
            'Dec' => 'Déc'
        );

        /**
         * Faire un display classique
         */
        $display = parent::format($format);

        /**
         * Traduire;
         */
        if( strstr($format, 'l') ){
            $display = str_replace(array_keys($days_full), array_values($days_full), $display);
        }
        if( strstr($format, 'D') ){
            $display = str_replace(array_keys($days_small), array_values($days_small), $display);
        }
        if( strstr($format, 'F') ){
            $display = str_replace(array_keys($months_full), array_values($months_full), $display);
        }
        if( strstr($format, 'M') ){
            $display = str_replace(array_keys($months_small), array_values($months_small), $display);
        }

        return $display;
    }
}