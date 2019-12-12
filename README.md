# National Address API Docs
https://api.address.gov.sa/

----------------------------
# Test :-

```php
require_once 'NationalAddressClass.php';
$NAAPI = new NationalAddressAPI('YOUR-API-KEY'); // https://api.address.gov.sa/

/* ----------------------------------------------- */
// **     https://api.address.gov.sa/docs       ** //
/* ----------------------------------------------- */

# Address API
$AddressGeocode = $NAAPI->AddressGeocode('latitude', 'longitude');
$BulkSearch = $NAAPI->BulkSearch('anyAddress');
$FixedSearch = $NNAPI->FixedSearch('cityId', 'districtId', 'buildingNumber', 'zipCode', 'additionalNumber', 'cityName', 'districtName', 'streetName');
$FreeText = $NNAPI->FreeText('addressString');
$GetExtentsFeature = $NNAPI->GetExtentsFeature('layerName', 'featureId');
$SearchNearestPOI = $NNAPI->SearchNearestPOI('latitude', 'longitude', 'redius');
$FixedSearchPOI = $NNAPI->FixedSearchPOI('cityId', 'districtId', 'buildingNumber', 'zipCode', 'additionalNumber', 'cityName', 'districtName', 'streetName', 'servicecategoryId', 'servicesubcategoryId', 'regionId');
$FreeTextPOI = $NNAPI->FreeTextPOI('serviceString');
$VerifyAddress = $NNAPI->VerifyAddress('buildingNumber', 'zipCode', 'additionalNumber');

# Lookups API
$RegionsLookup = $NAAPI->RegionsLookup();
$ServiceCategoriesLookup = $NAAPI->ServiceCategoriesLookup();
$CityLookup = $NAAPI->CityLookup('regionId');
$DistrictsLookup = $NAAPI->DistrictsLookup('cityId');
$ServiceSubCategoriesLookup = $NAAPI->ServiceSubCategoriesLookup('servicecategoryId')

# Maps API
$MapEngine = $NAAPI->MapEngine();
?>
```
