<?php

class HighriseCase extends HighriseAPI
{
	private $highrise;
	public $id;
	public $name;

	public function __construct(HighriseAPI $highrise)
	{
		$this->account = $highrise->account;
		$this->token = $highrise->token;
		$this->debug = $highrise->debug;
		$this->curl = curl_init();		
		
	}

	public function save() {
		$case_xml = $this->toXML();


		if ($this->debug) {
			print_r($case_xml);
		}

		$new_xml = $this->postDataWithVerb("/kases.xml", $case_xml, "POST");
		$this->loadFromXMLObject(simplexml_load_string($new_xml));
		
		return true;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = (string)$name;
	}

	public function toXML()
	{

		$xml = new SimpleXMLElement("<kase></kase>");
		$xml->addChild("name",$this->getName());
	
		return $xml->asXML();
	}

	public function loadFromXMLObject($xml_obj)
	{
		if ($this->debug) {
			print_r($xml_obj);
		}

		$this->setId($xml_obj->{'id'});
		
		return true;
	}

	public function setId($id)
	{
		$this->id = (string)$id;
	}

	public function getId()
	{
		return $this->id;
	}		
}
