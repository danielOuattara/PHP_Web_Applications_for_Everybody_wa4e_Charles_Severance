<?php

$chuck = array(
	"full_name" => "Chuck Severance",
	'room' => '3437NQ'
);

$colleen = array(
	"family_name" => "van Lent",
	'given_name' => 'Colleen',
	'room' => '3439NQ'
);

function get_person_info($person)
{
	if (isset($person['full_name'])) {
		return $person['full_name'];
	} elseif (isset($person['family_name']) && isset($person['given_name'])) {
		return $person['given_name'] . ' ' . $person['family_name'];
	} else {
		return false;
	}
}

print get_person_info($chuck) . "\n";
print get_person_info($colleen) . "\n";
