<?php
/* Current number of wins*/
$curr = array();
$curr['csk'] = 10;
$curr['rr'] = 9;
$curr['mi'] = 9;
$curr['srh'] = 8;
$curr['rcb'] = 8;

/* Upcoming matches*/
$matches = array();
$matches[]=array('kkr','rcb');
$matches[]=array('rr','csk');
$matches[]=array('mi','srh');
$matches[]=array('rcb','kxip');
$matches[]=array('csk','dd');
$matches[]=array('mi','rr');
$matches[]=array('srh','rr');
$matches[]=array('kxip','mi');
$matches[]=array('rcb','csk');
$matches[]=array('srh','kkr');

$numMatches = count($matches);
$numPossibleOutcomes = pow(2,$numMatches);

echo "numPossibleOutcomes = $numPossibleOutcomes\n";

$yes = 0;
$no = 0;
$mayBe = 0;

for($possIter = 0; $possIter < $numPossibleOutcomes; $possIter++) {
	$final = $curr;
	for($matchIter = 0; $matchIter < $numMatches; $matchIter++) {
		$winnerIndex = ($possIter >> $matchIter) & 1;	
		$winner = $matches[$matchIter][$winnerIndex]; 
		//echo $winner." ";
		if(isset($final[$winner])) {
			$final[$winner] += 1;
		}
	}
	$rrWins = $final['rr'];
	rsort($final);
	if($rrWins > $final[4]) { //RR has won more than the fifth placed team
		$yes++;
	} else if($rrWins < $final[3]) { //RR has won less than the fourth placed team
		$no++;
	} else { // There is a tie between 4th and 5th place and RR is one of them 
		$mayBe++;
	};
} 
$yesProb = round(($yes/$numPossibleOutcomes),3);
$noProb = round(($no/$numPossibleOutcomes),3);
$mayBeProb = round(($mayBe/$numPossibleOutcomes),3);
echo "yes = $yesProb no = $noProb mayBe = $mayBeProb";
?>
