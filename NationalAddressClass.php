 <?php
class NationalAddressAPI {
	// Define the properties
	public $api_key;
	
	public function __construct($api_key) {
		$this->api_key = $api_key; // https://api.address.gov.sa/developer
	}
	
	public function API($endpoint) {
		$headers = array(
			'Host: apina.address.gov.sa',
			'api_key: ' . $this->api_key
		);
		
		$API = curl_init();
		curl_setopt($API, CURLOPT_URL, 'https://apina.address.gov.sa/NationalAddress/' . $endpoint);
		curl_setopt($API, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($API, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($API);
		curl_close($API);
		return $response ;
	}

	/*
	*
	* Address Reverse Geocode API returns different outputs based on conditions as mentioned below :-
	*	  - If an address is found then service returns Parcel Address .
	*	  - If the point is outside KSA and address or postal code is not found it returns No results .
	*
	* @param int $latitude
	*
	* @param int $longitude
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @return Response
	*
	*/
	public function AddressGeocode($latitude, $longitude, $language = 'A', $mime_type= 'json', $encode = 'utf8'){
		$data = $this->API("v3.1/Address/address-geocode?lat=${latitude}&long=${longitude}&language=${language}&format=${mime_type}&encode=${encode}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Search bulk address API allows user to find complete details of multiple address by providing building number, zip code for the addresses .
	*
	* @param int $latitude
	*
	* @param int $longitude
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param int $page
	*
	* @return Response
	*
	*/
	public function BulkSearch($address, $language = 'A', $mime_type = 'json', $encode = 'utf8', $page = '1'){
		$data = $this->API("v3.1/Address/address-bulk?addressstring=${address}&language=${language}&format=${mime_type}&encode=${encode}&page=${page}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Fixed search allows a user to find complete details of an address by providing some details about that address by fixed parameters. Using the service user can complete an address to enable its user to reach there comfortably even if they know only some details about it.
	*
	* @param int $cityId
	*
	* @param int $districtId
	*
	* @param int $buildingNumber
	*
	* @param int $zipCode
	*
	* @param int $additionalNumber
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param int $page
	*
	* @return Response
	*
	*/
	public function FixedSearch($cityId, $districtId, $buildingNumber, $zipCode, $additionalNumber, $cityName, $districtName, $streetName, $language = 'A', $mime_type = 'json', $encode = 'utf8', $page = '1'){
		$data = $this->API("v3.1/Address/address-fixed-params?language=${language}&format=${mime_type}&encode=${encode}&page=${page}&cityId=${cityId}&districtId=${districtId}&buildingnumber=${buildingNumber}&zipcode=${zipCode}&additionalnumber=${additionalNumber}&cityname=${cityName}&districtname=${districtName}&streetname=${streetName}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Free text search allows a user to find complete details of an address by providing limited details about an address as a free text.
	*
	* @param string $addressString
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param int $page
	*
	* @return Response
	*
	*/
	public function FreeText($addressString, $language = 'A', $mime_type= 'json', $encode = 'utf8', $page = '1'){
		$data = $this->API("v3.1/Address/address-free-text?addressstring=${addressString}&language=${language}&format=${mime_type}&encode=${encode}&page=${page}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Get extents of a feature, allows a user to get boundary extents of a single feature. Here a feature can be a Region, City, District, Street or a Zipcode. This will allow users to zoom to a particular feature by its extents.
	*
	* @param string $layerName
	*
	* @param string $featureId
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @return Response
	*
	*/
	public function GetExtentsFeature($layerName, $featureId, $mime_type= 'json', $encode = 'utf8'){
		$data = $this->API("v3.1/Address/address-free-text?layername=${layerName}&featureid=${featureId}&format=${mime_type}&encode=${encode}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Search nearest service API allows a user to find availability of service he is looking for within a defined radius of an area provided by a user as an input.
	*
	* @param int $latitude
	*
	* @param int $longitude
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param string $radius
	*
	* @return Response
	*
	*/
	public function SearchNearestPOI($latitude, $longitude, $redius = '0.5', $language = 'A', $mime_type= 'json', $encode = 'utf8'){
		$data = $this->API("v3.1/Address/poi-nearest?lat=${latitude}&long=${longitude}&language=${language}&format=${mime_type}&encode=${encode}&radius=${redius}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* POI's fixed search allows a user to find availability of a service he is looking for by providing details of service by fixed parameters. 
	*
	* @param int $cityId
	*
	* @param int $districtId
	*
	* @param int $buildingNumber
	*
	* @param int $zipCode
	*
	* @param int $additionalNumber
	*
	* @param int $servicecategoryId
	*
	* @param int $servicesubcategoryId
	*
	* @param int $regionid
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param int $page
	*
	* @return Response
	*
	*/
	public function FixedSearchPOI($cityId, $districtId, $buildingNumber, $zipCode, $additionalNumber, $cityName, $districtName, $streetName, $servicecategoryId, $servicesubcategoryId, $regionId, $language = 'A', $mime_type = 'json', $encode = 'utf8', $page = '1'){
		$data = $this->API("v3.1/Address/poi-fixed-params?language=${language}&format=${mime_type}&encode=${encode}&page=${page}&cityId=${cityId}&districtId=${districtId}&buildingnumber=${buildingNumber}&zipcode=${zipCode}&additionalnumber=${additionalNumber}&cityname=${cityName}&districtname=${districtName}&streetname=${streetName}&servicecategoryId=${servicecategoryId}&servicesubcategoryId=${servicesubcategoryId}&regionid=${regionId}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* POI's free text search allows a user to find availability of a service he is looking for by providing details of service as a free text string input. 
	*
	* @param string $serviceString
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param int $page
	*
	* @return Response
	*
	*/
	public function FreeTextPOI($serviceString, $language = 'A', $mime_type= 'json', $encode = 'utf8', $page = '1'){
		$data = $this->API("v3.1/Address/poi-free-text?servicestring=${serviceString}&language=${language}&format=${mime_type}&encode=${encode}&page=${page}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Verify address API allows user to verify a given address. If an address is verified then true is returned else false.  
	*
	* @param int $buildingNumber
	*
	* @param int $zipcode
	*
	* @param string $additionalNumber
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $encode
	*
	* @param int $page
	*
	* @return Response
	*
	*/
	public function VerifyAddress($buildingNumber, $zipCode, $additionalNumber, $language = 'A', $mime_type= 'json', $encode = 'utf8', $page = '1'){
		$data = $this->API("v3.1/Address/address-verify?buildingnumber=${buildingNumber}&zipcode=${zipCode}&additionalnumber=${additionalNumber}&language=${language}&format=${mime_type}&encode=${encode}&page=${page}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* cities Lookups 
	*
	* @param int $regionId
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @return Response
	*
	*/
	public function CityLookup($regionId, $language = 'A', $mime_type= 'json'){
		$data = $this->API("v3.1/lookup/cities?regionid=${regionId}&language=${language}&format=${mime_type}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* districts Lookups 
	*
	* @param int $cityId
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @return Response
	*
	*/
	public function DistrictsLookup($cityId, $language = 'A', $mime_type= 'json'){
		$data = $this->API("v3.1/lookup/districts?cityid=${cityId}&language=${language}&format=${mime_type}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* regions Lookups 
	*
	* @param string $language
	*
	* @param string $mime_type
	*
	* @param string $format
	*
	* @return Response
	*
	*/
	public function RegionsLookup($encode = 'utf8', $language = 'A', $mime_type= 'json'){
		$data = $this->API("v3.1/lookup/regions?cityid=${cityId}&language=${language}&format=${mime_type}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* service-categories Lookups 
	*
	* @param string $language
	*
	* @param string $format
	*
	* @return Response
	*
	*/
	public function ServiceCategoriesLookup($language = 'A', $mime_type= 'json'){
		$data = $this->API("v3.1/lookup/service-categories?language=${language}&format=${mime_type}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* service-sub-categories Lookups 
	*
	* @param string $servicecategoryId
	*
	* @param string $language
	*
	* @param string $format
	*
	* @return Response
	*
	*/
	public function ServiceSubCategoriesLookup($servicecategoryId, $language = 'A', $mime_type= 'json'){
		$data = $this->API("v3.1/lookup/service-sub-categories?servicecategoryid=${servicecategoryId}&language=${language}&format=${mime_type}");
		return $data; // JSON (default) ? XML ?
	}
	
	/*
	*
	* Map Engine
	*
	* @return Response
	*
	*/
	public function MapEngine(){
		$data = $this->API("v3.1/maps/map-engine");
		return $data; // JSON (default) ? XML ?
	}
}
?>
