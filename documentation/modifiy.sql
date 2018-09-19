DROP VIEW humanresources.vEmployee;
DROP VIEW humanresources.vEmployeeDepartment;
DROP VIEW humanresources.vEmployeeDepartmentHistory;
DROP VIEW humanresources.vJobCandidate;
DROP VIEW humanresources.vJobCandidateEducation;
DROP VIEW humanresources.vJobCandidateEmployment;

DROP VIEW person.vAdditionalContactInfo;
DROP VIEW person.vStateProvinceCountryRegion;

DROP VIEW production.vProductAndDescription;
DROP VIEW production.vProductModelCatalogDescription;
DROP VIEW production.vProductModelInstructions;

DROP VIEW Purchasing.vVendorWithAddresses;
DROP VIEW Purchasing.vVendorWithContacts;

DROP VIEW Sales.vIndividualCustomer;
DROP VIEW Sales.vPersonDemographics;
DROP VIEW Sales.vSalesPerson;
DROP VIEW Sales.vSalesPersonSalesByFiscalYears;
DROP VIEW Sales.vStoreWithAddresses;
DROP VIEW Sales.vStoreWithContacts;
DROP VIEW Sales.vStoreWithDemographics;

ALTER TABLE sales.customer DROP CONSTRAINT DF_Customer_rowguid;
DROP INDEX AK_Customer_rowguid ON sales.customer;
ALTER TABLE sales.customer DROP COLUMN rowguid;

ALTER TABLE humanresources.department ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE humanresources.employee ALTER COLUMN SalariedFlag bit NOT NULL;
ALTER TABLE humanresources.employee ALTER COLUMN CurrentFlag bit NOT NULL;
ALTER TABLE humanresources.employee DROP CONSTRAINT DF_Employee_rowguid;
DROP INDEX AK_Employee_rowguid ON humanresources.employee;
ALTER TABLE humanresources.employee DROP COLUMN rowguid;

ALTER TABLE humanresources.shift ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.address DROP CONSTRAINT DF_Address_rowguid;
DROP INDEX AK_Address_rowguid ON person.address;
ALTER TABLE person.address DROP COLUMN rowguid;

ALTER TABLE person.businessentity DROP CONSTRAINT DF_BusinessEntity_rowguid;
DROP INDEX AK_BusinessEntity_rowguid ON person.businessentity;
ALTER TABLE person.businessentity DROP COLUMN rowguid;

ALTER TABLE person.businessentityaddress DROP CONSTRAINT DF_BusinessEntityAddress_rowguid;
DROP INDEX AK_BusinessEntityAddress_rowguid ON person.businessentityaddress;
ALTER TABLE person.businessentityaddress DROP COLUMN rowguid;

ALTER TABLE person.countryregion ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.emailaddress DROP CONSTRAINT DF_EmailAddress_rowguid;
ALTER TABLE person.emailaddress DROP COLUMN rowguid;

ALTER TABLE person.password DROP CONSTRAINT DF_Password_rowguid;
ALTER TABLE person.password DROP COLUMN rowguid;

DROP INDEX IX_Person_LastName_FirstName_MiddleName ON person.person;
ALTER TABLE person.person ALTER COLUMN namestyle bit NOT NULL;
ALTER TABLE person.person ALTER COLUMN firstname nvarchar(50) NOT NULL;
ALTER TABLE person.person ALTER COLUMN middlename nvarchar(50) NULL;
ALTER TABLE person.person ALTER COLUMN lastname nvarchar(50) NOT NULL;
ALTER TABLE person.person DROP CONSTRAINT DF_Person_rowguid;
DROP INDEX AK_Person_rowguid ON person.person;
ALTER TABLE person.person DROP COLUMN rowguid;

ALTER TABLE person.addresstype DROP CONSTRAINT DF_AddressType_rowguid;
DROP INDEX AK_AddressType_rowguid ON person.addresstype;
ALTER TABLE person.addresstype DROP COLUMN rowguid;

ALTER TABLE person.businessentitycontact DROP CONSTRAINT DF_BusinessEntityContact_rowguid;
DROP INDEX AK_BusinessEntityContact_rowguid ON person.businessentitycontact;
ALTER TABLE person.businessentitycontact DROP COLUMN rowguid;

ALTER TABLE person.personphone ALTER COLUMN phonenumber nvarchar(25) NOT NULL;

ALTER TABLE person.phonenumbertype ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.stateprovince ALTER COLUMN isonlystateprovinceflag bit NOT NULL;
ALTER TABLE person.stateprovince ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE person.stateprovince DROP CONSTRAINT DF_StateProvince_rowguid;
DROP INDEX AK_StateProvince_rowguid ON person.stateprovince;
ALTER TABLE person.stateprovince DROP COLUMN rowguid;

ALTER TABLE production.culture ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.location ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.product ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.product ALTER COLUMN makeflag bit NOT NULL;
ALTER TABLE production.product DROP CONSTRAINT DF_Product_rowguid;
DROP INDEX AK_Product_rowguid ON production.product;
ALTER TABLE production.product DROP COLUMN rowguid;

ALTER TABLE production.productcategory ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.productcategory DROP CONSTRAINT DF_ProductCategory_rowguid;
DROP INDEX AK_ProductCategory_rowguid ON production.productcategory;
ALTER TABLE production.productcategory DROP COLUMN rowguid;

ALTER TABLE production.productdescription DROP CONSTRAINT DF_ProductDescription_rowguid;
DROP INDEX AK_ProductDescription_rowguid ON production.productdescription;
ALTER TABLE production.productdescription DROP COLUMN rowguid;

ALTER TABLE production.productdescription DROP CONSTRAINT DF_ProductDescription_rowguid;
DROP INDEX AK_ProductDescription_rowguid ON production.productdescription;
ALTER TABLE production.productdescription DROP COLUMN rowguid;

ALTER TABLE production.productinventory DROP CONSTRAINT DF_ProductInventory_rowguid;
ALTER TABLE production.productinventory DROP COLUMN rowguid;

ALTER TABLE production.productmodel ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.productmodel DROP CONSTRAINT DF_ProductModel_rowguid;
DROP INDEX AK_ProductModel_rowguid ON production.productmodel;
ALTER TABLE production.productmodel DROP COLUMN rowguid;

ALTER TABLE production.productphoto DROP COLUMN thumbnailphoto;
ALTER TABLE production.productphoto DROP COLUMN largephotofilename;
ALTER TABLE production.productphoto DROP COLUMN largephoto;

ALTER TABLE production.productproductphoto ALTER COLUMN [primary] bit NOT NULL;

ALTER TABLE production.productreview ALTER COLUMN reviewername nvarchar(50) NOT NULL;

ALTER TABLE production.productsubcategory ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.productsubcategory DROP CONSTRAINT DF_ProductSubcategory_rowguid;
DROP INDEX AK_ProductSubcategory_rowguid ON production.productsubcategory;
ALTER TABLE production.productsubcategory DROP COLUMN rowguid;

ALTER TABLE production.scrapreason ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.unitmeasure ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.workorder DROP COLUMN stockedqty;

ALTER TABLE production.purchaseorderheader DROP COLUMN totaldue;
