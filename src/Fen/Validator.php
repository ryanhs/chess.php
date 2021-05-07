<?php

declare(strict_types=1);
/**
 * Chess.php
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2021 ryan hs
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Ryanhs\Chess\Fen;

/**
 * Provides an fen validator.
 */
trait Validator
{
    /** @var array $errors A list of fen validation errors. */
    public array $errors = [
        'FEN string must contain six space-delimited fields.',
        '6th field (move number) must be a positive integer.',
        '5th field (half move counter) must be a non-negative integer.',
        '4th field (en-passant square) is invalid.',
        '3rd field (castling availability) is invalid.',
        '2nd field (side to move) is invalid.',
        '1st field (piece positions) does not contain 8 \'/\'-delimited rows.',
        '1st field (piece positions) is invalid [consecutive numbers].',
        '1st field (piece positions) is invalid [invalid piece].',
        '1st field (piece positions) is invalid [row too large].',
        'Illegal en-passant square',
    ];

    /**
     * Validate the fen.
     *
     * @param string $fen The fen to validate.
     *
     * @throws \Ryanhs\Chess\Exception\InvalidFenException If the fen is invalid.
     *
     * @return void Returns nothing.
     */
    public function validateFen(string $fen): void
    {
        $parts = explode(' ', $fen);
        if (count($parts) !== 6) {
            // 1st criterion: 6 space-separated fields
            throw new InvalidFenException($this->errors[0]);
        } elseif (!ctype_digit($parts[5]) || intval($parts[5]) <= 0) {
            // 2nd criterion: move number field is a integer value > 0
            throw new InvalidFenException($this->errors[1]);
        } elseif (!ctype_digit($parts[4]) || intval($parts[4]) < 0) {
            // 3rd criterion: half move counter is an integer >= 0
            throw new InvalidFenException($this->errors[2]);
        } elseif (!(preg_match('/^(-|[a-h]{1}[3|6]{1})$/', $parts[3]) === 1)) {
            // 4th criterion: 4th field is a valid e.p.-string
            throw new InvalidFenException($this->errors[3]);
        } elseif (!(preg_match('/(^-$)|(^[K|Q|k|q]{1,}$)/', $parts[2]) === 1)) {
            // 5th criterion: 3th field is a valid castle-string
            throw new InvalidFenException($this->errors[4]);
        } elseif (!(preg_match('/^(w|b)$/', $parts[1]) === 1)) {
            // 6th criterion: 2nd field is "w" (white) or "b" (black)
            throw new InvalidFenException($this->errors[5]);
        } else {
            $rows = explode('/', $parts[0]);
            $rowCount = count($rows);
            if ($rowCount !== 8) {
                // 7th criterion: 1st field contains 8 rows
                throw new InvalidFenException($this->errors[6]);
            }
            for ($i = 0; $i < $rowCount; ++$i) {
                $sumFields = 0;
                $previousWasNumber = false;
                for ($k = 0; $k < strlen($rows[$i]); ++$k) {
                    if (ctype_digit($rows[$i][$k])) {
                        if ($previousWasNumber) {
                            // 8th criterion: every row is valid
                            throw new InvalidFenException($this->errors[7]);
                        }
                        $sumFields += intval($rows[$i][$k]);
                        $previousWasNumber = true;
                    } else {
                        if (strpos('pnbrqkPNBRQK', $rows[$i][$k]) === false) {
                            // 9th criterion: check symbols of piece
                            throw new InvalidFenException($this->errors[8]);
                        }
                        ++$sumFields;
                        $previousWasNumber = false;
                    }
                }
            }
            if ($sumFields !== 8) {
                // 10th criterion: check sum piece + empty square must be 8
                throw new InvalidFenException($this->errors[9]);
            }
        }
        if (strlen($parts[3]) > 1) {
            if (($parts[3][1] == '3' && $parts[1] == 'w') ||
                ($parts[3][1] == '6' && $parts[1] == 'b')) {
                // 11th criterion: en-passant if last is black's move, then its must be white turn
                throw new InvalidFenException($this->errors[10]);
            }
        }
    }
}
