<?php
/**
 * Created by PhpStorm.
 * User: silvesterdenk
 * Date: 2019-04-08
 * Time: 11:02
 */

namespace App\Examples;


class Permutator
{
    protected $tokenizer;

    protected $permutations = [];

    protected $tokenLimit = 5;

    public function __construct(Tokenizer $tokenizer)
    {
        $this->tokenizer = $tokenizer;
    }

    public function buildPermutations(string $term): ?array
    {
        $this->permutations = [];
        $tokens = $this->tokenizer->tokenize($term);

        if (count($tokens) > $this->tokenLimit || count($tokens) <= 1) {
            return null;
        }

        $excludeAsFirstElement = [];
        foreach ($tokens as $key => $token) {
            if (strpos($tokens[0], $token) === 0) {
                $excludeAsFirstElement[$key] = true;
            }
        }

        $tokenKeys = array_keys($tokens);
        $this->generatePermutations($tokenKeys, [], $excludeAsFirstElement);
        return $this->resolvePermutations($tokens);
    }

    protected function generatePermutations(array $bagOfElements, array $chosenElements = [], array $skipKeys = [])
    {
        foreach ($bagOfElements as $key => $element) {
            if (isset($skipKeys[$key])) {
                continue;
            }

            $currentChosenElements = $chosenElements;
            $currentChosenElements[] = $element;

            $bagWithoutCurrent = $bagOfElements;
            unset($bagWithoutCurrent[$key]);

            if (!empty($bagWithoutCurrent)) {
                $this->generatePermutations($bagWithoutCurrent, $currentChosenElements);
            } else {
                $this->permutations[] = $currentChosenElements;
            }
        }
    }

    protected function resolvePermutations(array $tokens)
    {
        $resolved = [];
        foreach ($this->permutations as $permutation) {
            $resolved[] = $this->buildTokenString($permutation, $tokens);
        }
        return $resolved;
    }

    protected function buildTokenString($permutation, $tokens)
    {
        foreach ($permutation as &$key) {
            $key = $tokens[$key];
        }
        return implode(' ', $permutation);
    }
}