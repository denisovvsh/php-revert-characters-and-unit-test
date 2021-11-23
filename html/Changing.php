<?php
class Changing
{
	public function revertCharacters($str)
	{
		$newString = '';
		$arrWords = preg_split("/[\s]+/", $str);

		foreach($arrWords as $word)
		{
			$encoding = mb_detect_encoding($word);
			$lengthWord = mb_strlen($word, $encoding);

			$arrSymbols = [];
			for($i = 0; $i < $lengthWord; $i++)
			{
				$arrSymbols[] = mb_substr($word, $i, 1, $encoding);
			}

			$newString .= $this->prepareWord($arrSymbols, $encoding);
			continue;
		}

		return trim($newString);
	}

	private function prepareWord($arrSymbols, $encoding)
	{
		$lengthArr = count($arrSymbols);

		if($lengthArr == 1) return $arrSymbols[0]." ";

		if(preg_match('/^[A-ZА-ЯЁ]+$/u', $arrSymbols[0]) && preg_match('/[a-zа-яё]/i', $arrSymbols[$lengthArr-1]))
		{
			$arrSymbols[$lengthArr-1] = mb_strtoupper($arrSymbols[$lengthArr-1], $encoding);
			$arrSymbols[0] = mb_strtolower($arrSymbols[0], $encoding);
			return implode(array_reverse($arrSymbols))." ";
		}

		if(preg_match('/^[A-ZА-ЯЁ]+$/u', $arrSymbols[0]) && !preg_match('/[a-zа-яё]/i', $arrSymbols[$lengthArr-1]))
		{
			$symbol = $arrSymbols[$lengthArr-1];
			unset($arrSymbols[$lengthArr-1]);
			$arrSymbols[$lengthArr-2] = mb_strtoupper($arrSymbols[$lengthArr-2], $encoding);
			$arrSymbols[0] = mb_strtolower($arrSymbols[0], $encoding);
			return implode(array_reverse($arrSymbols)).$symbol." ";
		}

		if(!preg_match('/^[A-ZА-ЯЁ]+$/u', $arrSymbols[0]) && preg_match('/[a-zа-яё]/i', $arrSymbols[$lengthArr-1]))
			return implode(array_reverse($arrSymbols))." ";

		if(!preg_match('/^[A-ZА-ЯЁ]+$/u', $arrSymbols[0]) && !preg_match('/[a-zа-яё]/i', $arrSymbols[$lengthArr-1]))
		{
			$symbol = $arrSymbols[$lengthArr-1];
			unset($arrSymbols[$lengthArr-1]);
			return implode(array_reverse($arrSymbols)).$symbol." ";
		}

		return;
	}
}
?>