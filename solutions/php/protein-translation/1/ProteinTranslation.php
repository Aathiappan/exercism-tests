<?php declare(strict_types=1);

class ProteinTranslation
{
    public const PROTEINS = ['AUG' => 'Methionine','UUU' => 'Phenylalanine', 'UUC' => 'Phenylalanine','UUA' => 'Leucine', 'UUG' => 'Leucine', 'UCU' => 'Serine', 'UCC' => 'Serine', 'UCA' => 'Serine', 'UCG' => 'Serine','UAU' => 'Tyrosine', 'UAC' => 'Tyrosine','UGU' => 'Cysteine', 'UGC' => 'Cysteine','UGG' => 'Tryptophan','UAA' => 'STOP', 'UAG' => 'STOP', 'UGA' => 'STOP'];
    public function getProteins(string $codon):array
    {
        if($codon === ''){
            return [];
        }else{
            $codonList = str_split($codon,3);
            $result = [];
            foreach($codonList as $item){
                if(!isset($this::PROTEINS[$item])){
                    throw new InvalidArgumentException('Invalid codon');
                }else{
                    if($this::PROTEINS[$item] === 'STOP'){
                        return $result;
                    }else{
                        $result[] = $this::PROTEINS[$item];
                    }
                }
            }
        }
        return $result;
    }
}
