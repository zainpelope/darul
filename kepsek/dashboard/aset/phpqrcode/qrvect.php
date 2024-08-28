<?php
/*
 * PHP QR Code encoder
 *
 * Image output of code using GD2
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

define('QR_VECT', true);

class QRvect
{

    //----------------------------------------------------------------------
    public static function eps($frame, $filename = false, $pixelPerPoint = 4, $outerFrame = 4, $saveandprint = false, $back_color = 0xFFFFFF, $fore_color = 0x000000, $cmyk = false)
    {
        $vect = self::vectEPS($frame, $pixelPerPoint, $outerFrame, $back_color, $fore_color, $cmyk);

        if ($filename === false) {
            header("Content-Type: application/postscript");
            header('Content-Disposition: filename="qrcode.eps"');
            echo $vect;
        } else {
            if ($saveandprint === true) {
                QRtools::save($vect, $filename);
                header("Content-Type: application/postscript");
                header('Content-Disposition: filename="qrcode.eps"');
                echo $vect;
            } else {
                QRtools::save($vect, $filename);
            }
        }
    }

    //----------------------------------------------------------------------
    private static function vectEPS($frame, $pixelPerPoint = 4, $outerFrame = 4, $back_color = 0xFFFFFF, $fore_color = 0x000000, $cmyk = false)
    {
        $h = count($frame);
        $w = strlen($frame[0]);

        $imgW = $w + 2 * $outerFrame;
        $imgH = $h + 2 * $outerFrame;

        if ($cmyk) {
            $c = round((($fore_color & 0xFF000000) >> 16) / 255, 5);
            $m = round((($fore_color & 0x00FF0000) >> 16) / 255, 5);
            $y = round((($fore_color & 0x0000FF00) >> 8) / 255, 5);
            $k = round(($fore_color & 0x000000FF) / 255, 5);
            $fore_color_string = $c . ' ' . $m . ' ' . $y . ' ' . $k . ' setcmykcolor' . "\n";

            $c = round((($back_color & 0xFF000000) >> 16) / 255, 5);
            $m = round((($back_color & 0x00FF0000) >> 16) / 255, 5);
            $y = round((($back_color & 0x0000FF00) >> 8) / 255, 5);
            $k = round(($back_color & 0x000000FF) / 255, 5);
            $back_color_string = $c . ' ' . $m . ' ' . $y . ' ' . $k . ' setcmykcolor' . "\n";
        } else {
            $r = round((($fore_color & 0xFF0000) >> 16) / 255, 5);
            $b = round((($fore_color & 0x00FF00) >> 8) / 255, 5);
            $g = round(($fore_color & 0x0000FF) / 255, 5);
            $fore_color_string = $r . ' ' . $b . ' ' . $g . ' setrgbcolor' . "\n";

            $r = round((($back_color & 0xFF0000) >> 16) / 255, 5);
            $b = round((($back_color & 0x00FF00) >> 8) / 255, 5);
            $g = round(($back_color & 0x0000FF) / 255, 5);
            $back_color_string = $r . ' ' . $b . ' ' . $g . ' setrgbcolor' . "\n";
        }

        $str = '%!PS-Adobe-3.0 EPSF-3.0' . "\n";
        $str .= '%%BoundingBox: 0 0 ' . ($imgW * $pixelPerPoint) . ' ' . ($imgH * $pixelPerPoint) . "\n";
        $str .= '%%Creator: PHP QR Code' . "\n";
        $str .= '%%Title: QR Code' . "\n";
        $str .= '%%EndComments' . "\n";
        $str .= $back_color_string;
        $str .= '1 setgray' . "\n";
        $str .= 'newpath' . "\n";

        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                if ($frame[$y][$x] == '1') {
                    $str .= ($x + $outerFrame) * $pixelPerPoint . ' ' . (($h - $y - 1) + $outerFrame) * $pixelPerPoint . ' ' . $pixelPerPoint . ' ' . $pixelPerPoint . ' rectfill' . "\n";
                }
            }
        }

        $str .= 'showpage' . "\n";

        return $str;
    }
}
