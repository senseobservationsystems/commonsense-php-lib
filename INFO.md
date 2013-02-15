CommonSense PHP API Library
===================

A PHP class library for the communication between your PHP application and the Sense API. Easy to add in your application directory.

Class: class.Api.PHP
--------------------

Handles all the API calls.

### `api()` 

Constructor.

### `getSessionId()`

Returns the session id if exists.

### `setSessionId(Integer $sessionid)`

Set the session id of a user. 

### `getErrorLog()`

Returns the error log as a String. 

### `login($username, $password)`

Logs in with username and MD5 password hash. The function sets the session ID that is required for authentication of further calls. A user can be logged in on multiple locations. Returns true or false.

### `oauthLogin($key, $secret)`

Logs in using oAuth.

### `logout()`

Logs out the user by destroying its session.

### `listDevices()`

Returns all the user's devices that have sensors as list of `Device` objects.

### `readDevice($id)`

Returns the details of a device that has sensors as a `Device` object.

### `readDeviceSensors($id, $page, $perPage, $details)`

Returns the sensors that are physically connected to the device as a list of `Sensor` objects.

### `addEnvironment($name, $floors, $gps_outlines, $position)`

Creates a new environment. The `gps_outline` field should contain a list of latitude longitude points describing the outline of the environment. The list of points should create a polygon. The latitude longitude coordinates are separated by a space and each tuple by a comma. Optionally a third coordinate altitude can be specified after the longitude separated by a space. The `gps_outline` field can have 8000 characters. The position field should be the center of the environment which is also a gps point in the order latitude longitude altitude separated by spaces. The field floors indicates the amount of floors the environment has.

### `deleteEnvironment($id)`

Deletes an environment.

### `listEnvironments()`

Returns a list of `Environment` objects of the current user.

### `readEnvironment($id)`

Returns the details of the selected environment, as an `Environment`object.

### `updateEnvironment($id, $name)`

Updates an environment. Only the fields that are sent will be updated.

### `listGroups()`

Returns a list of groups that the current user is a member of. Returns a `Group` object.

### `createGroup($email, $name, $username, $password)`

Creates a group to which the current user will be added. A group can optionally have a username and password which can be used for login. The password must be in MD5 format.

### `readGroup($id)`

Returns the details of a group. Only members of a group can see the details of a group. Returns a `Group` object.

### `updateGroup($id, $email, $username, $password, $name)`

Updates the details of a group. Only the values specified as input will be updates. Every member of the group can update the group details.

### `deleteGroup($id)`

Deletes the group if the group has no other members. If the group has other members then the current user will be removed from the group.

### `listUsersOfGroup($id)`

Returns the members of the group as a list of `User` objects. Only group members can perform this action.

### `addUserToGroup($id, $userID, $userName)`

Addd a user to the group. To add a user at least a username or user ID must be specified. Only members of the group can add a user to the group.

### `listSensors($page, $perPage, $shared, $owned, $physical)`

Returns a list of `Sensor` objects to which the current user has access.

### `createSensor($name, $displayName, $deviceType, $pagerType, $dataType, $dataStructure)`

Creates a new sensor. A sensor can optionally have a pager type which can be `email` or `sms`. Based on the pager type, a message with the current sensor value will be sent. The data type of a sensor can either be a value type (e.g. `float`, `string`) or `json`. With a `json` data type, a data structure that specifies the structure of the JSON object is expected.

### `readSensor($id)`

Returns a `Sensor` object.

### `updateSensorDescription($id, $name, $displayName, $deviceType, $pagerType, $dataType, $dataStructure)`

Updates an existing sensor.

### `deleteSensor($id)`

Deletes a sensor. If the current user is the owner of the sensor then the sensor will be removed from the current user and all other users. If the current user is not owner of the sensor then access to the sensor will be removed for this user.

### `listSensorData($id, $page, $perPage, $startDate, $endDate, $date, $next, $last, $sort, $total, $jsonvalue)`

Returns a list of sensor data. The maximum amount of data points that can be retrieved at once are 1000 items.

### `updateSensorSpecificData($id, $value, $date)`

Uploads sensor data. The uploaded data can either be a single value or an array.

### `deleteSensorData($sensorID, $dataID)`

Deletes a data point.

### `getFileLocation($sensorID, $dataID)`

The response header will contain a location header with the location of the file.

### `deleteFile($sensorID, $dataID)`

Deletes the file that is uploaded and stored under the name given in this sensor data value.

### `deleteAllFiles()`

Deletes all the uploaded files of the user.

### `uploadSensorData($json)`

Uploads sensor data for multiple sensors at once. The uploaded data can either be a single value or an array.

### `readSensorEnvironment($id)`

Returns the details of the environment of this sensor as `Environment` object.

### `addSensorsToEnvironment($id, $sensorIds)`

Adds a sensor to an environment. To connect an individual sensor a sensor object with only the sensor id can be given and to connect a list of sensors a sensors object with an array of sensor ids can be given.

### `listEnvironmentSensors($id)`

Lists the sensors which are connected to this environment. Returns a list of `Sensor` objects.

### `removeSensorFromEnvironment($environmentID, $sensorID)`

Removes the selected sensor from the selected environment.

### `readParentDevice($sensorID)`

Returns a `Device` object to witch the sensor is connected.

### `addToParentDevice($sensorID, $deviceID, $type, $uuid)`

Adds a sensor to a device. If the device does not exists then it will be created. Either a device_id or type and uuid combination is needed. The type of the sensor will then be automatically be set to 1.

### `removeFromParentDevice($sensorID)`

Removes a sensor from a device. The type of the device will then automatically be set to 0.

### `sharedUsers($sensorID)`

Lists the users that have access to the sensor. Returns a list of `User` objects.

### `addSharedUser($sensorID, $userID, $username)`

Adds a user to a sensor, giving the user access to the sensor and data. Only the owner of the sensor is able to upload data, mutate sensors and add users to their sensor. To add a user at least a username or user_id must be specified.

### `removeSharedUser($sensorID, $userID)`

Removes a users from a sensor, which removes the access to the sensor for this user.

### `listConnectedSensors($sensorID)`

Returns a list of `Sensor` objects that the sensor with uses.

### `connectSensor($sensorID, $connectedSensorID)`

Connects a sensor to the sensor selected with `sensorId`. The type of the selected sensor will be automatically set to 2 (virtual sensor).

### `removeConnectedSensor($sensorID, $connectedSensor)`

Removes a sensor from the parent sensor. If the parent sensor does not have any sensors that it uses, its type will automatically be set to 0. If this parent sensor is also a service, then the connected sensor will also be disconnected from the service.

### `listRunningServices($sensorID)`

Lists all the running services for a sensor. It also lists the data fields of the sensor that are used by each service. Returns a list of `Service` objects.

### `listAvailableServices($sensorID)`

Lists all the available services for a sensor based on its data fields. Returns a list of `Service` objects.

### `useService($sensorID, $json)`

Connects a sensor to a service. In the POST data a service object is posted with the name of the service that is used. If the id of an existing service object is specified then this sensor will be connected to that service. Otherwise a new service will be created. In the optional array 'data_fields' the data fields of the sensor that should be used by this service can be specified. For every new service a virtual sensor is created. Data send from this service is stored under that virtual sensor. Optionally a sensor object with the name and device_type for the virtual sensor can be posted along with the creation of the service.

### `disconnectFromService($sensorID, $serviceID)`

This method disconnects the parent sensor from the service. The service will be stopped if it's not used by other sensors.

### `listServiceMethods($sensorID, $serviceID)`

Lists all the available methods of the service. These methods can be accessed to set and retrieve the settings of a service.

### `runServiceGetMethod($sensorID, $serviceID, $method)`

To retrieve information about a service, one of its 'get_methods' can be accessed by specifying the method name in the request url.

### `runServiceSetMethod($sensorID, $serviceID, $method, $parameters)`

To change specific settings of a service, one of its 'set_methods' can be accessed by specifying the method name in the request url. The parameters for the method are send in a parameters array. The response content is based on the method return type. If the method does not have a return value then it will return an object with result ok if the method succeeds.

### `learnPattern($SensorID, $serviceID, $startData, $endDate, $label)`

With this method states can be learned using previously stored data. This method is currently only available for the state_recognition_service and the pose_prediction_service. By giving a class label, start and end date, a state will be learned using the data from all the associated sensors from within the given time range.

### `listAllAvailableServices()`

Lists all the available services for all the sensors. Available services are selected based on their data fields.

### `listAllUsers($page, $perPage)`

Lists all the users in the database with only their user_id, name and surname.

### `createUser($email, $username, $name, $surname, $mobile, $password)`

Creates a user in the database. The username must be unique and the password must be a md5 hashed password. The response content will be contain the created user information. The uuid is a uniquely generated id which can be used to retrieve data without logging in.

### `readUser($userID)`

Returns a `User` object. Only the current user can be selected. 

### `updateUser($userID, $email, $username, $name, $surname, $mobile, $password)`

Updates the details of the user. Only the user_id of the current user can be selected.

### `deleterUser($userID)`

Removes the user from the database together with his external services.

### `readCurrentUser()`

Returns the details of the current user as `User` object.

Class: User.PHP
---------------

*Handles all the user actions.*

### `User($data, $api)`

Constructor. Requires a data object and the Api class.

### `getID()`

Returns the specific user ID that can be used to identify the user when calling the API.

### `getEmail()`

Returns the e-mail address of the User.

### `getName()`

Returns the name of the User.

### `getSurname()`

Returns the surname of the User.

### `getMobile()`

Returns the mobile number of the User.

### `getOpenID()`

Returns the Open ID of the User.

### `getUniqueID()`

Returns the unique ID of the User (unused).

### `update($email, $username, $name, $surname, $mobile, $password)`

Updates the details of the user. Only the logged in user can be updated.

### `delete()`

Deletes the user. Only the logged in user can delete himself.

### `deleteAllMyData()`

Deletes all the added data of the current User. Only the logged in user can delete his own data.

### `addToGroup($groupid)`

Adds a user to the group. To add a user at least a username or user ID must be specified. Only members of the group can add a user to the group.

Class: Service.PHP
------------------

*Handles all the service actions*

### `Service($data, $api)`

Constructor. Requires a data object and the Api class.

### `getID()`

Returns the service ID.

### `getName()`

Returns the name of the Service.

### `getData_fields()`

Returns the Service data fields.

### `disconnectSensor($sensorID)`

Disconnects the parent sensor from the service. The service will be stopped if it is not used by other sensors.

Class: Sensor.PHP
-----------------

*Handles all the Sensor actions*

### `Sensor($data, $api)`

Constructor. Requires a data object and the Api class.

### `getID()`

Returns the ID of the Sensor.

### `getName()`

Returns the Sensor name.

### `getDeviceType()`

Returns the device type where the sensor belongs to.

### `update($name, $displayName, $deviceType, $pagerType, $dataType, $dataStructure)`

Updates the existing sensor.

### `delete()`

Deletes the sensor. If the current user is the owner of the sensor then the sensor will be removed from the current user and all other users. If the current user is not owner of the sensor then access to the sensor will be removed for this user.

### `getData($page, $perPage, $startDate, $endDate, $date, $next, $last, $sort, $total)`

Returns a list of sensor `Data `objects. The maximum amount of data points that can be retrieved at once are 1000 items.

### `updateData($value, $date)`

Uploads sensor data. The uploaded data can either be a single value or an array.

### `deleteData($dataID)`

Deletes a data point

### `uploadDataAsJson($json)`

Uploads sensor data for multiple sensors at once. The uploaded data can either be a single value or an array.

### `getMyDevice()`

Returns the details of the device to witch the sensor is connected as `Device` object.

### `getEnvironment()`

Returns the details of the environment of this sensor as `Environment `object.

### `addSharedUser($userID, $userID)`

Adds a user to a sensor, giving the user access to the sensor and data. Only the owner of the sensor is able to upload data, mutate sensors and add users to their sensor. To add a user at least a username or user_id must be specified.

### `removeSharedUser($userID)`

Removes a users from a sensor, which removes the access to the sensor for this user.

### `connectSensor($connectedSensorID)`

Connects a sensor to the sensor with the selected sensor ID. The type of the selected sensor will be automatically set to 2 (virtual sensor).

### `removeConnectedSensor($connectedSensor)`

Removes a sensor from the parent sensor. If the parent sensor does not have any sensors that it uses, its type will automatically be set to 0. If this parent sensor is also a service, then the connected sensor will also be disconnected from the service.

### `disconnectFromService($serviceID)`

Disconnects the parent sensor from the service. The service will be stopped if it is not used by other sensors.

Class: Group.PHP
----------------

*Handles all the Group actions*

### `Group($data, $api)`

Constructor. Requires a data object and the Api class.

### `getID()`

Returns the group ID.

### `getName()`

Returns the group name.

### `getEmail()`

Returns the registered group e-mail.

### `update($email, $username, $password, $name)`

Updates the details of a group. Only the values specified as input will be updates. Every member of the group can update the group details

### `delete()`

Deletes the group if the group has no other members. If the group has other members then the current user will be removed from the group.

### `getUsers()`

Returns the members of the group as a list of `User` objects. Only group members can perform this action.

### `addUser($userID, $userName)`

Adds a user to the group. To add a user at least a username or user ID must be specified. Only members of the group can add a user to the group.

Class: Environment.PHP
----------------------

*Handles all the Environment actions*

### `Environment($data, $api)`

Constructor. Requires a data object and the Api class.

### `getID()`

Returns the Environment ID.

### `getName()`

Returns the name of the Environment.

### `getFloors()`

Returns the number of floors of the Environment.

### `getGpsOutline()`

Returns the GPS outlines of the Environment.

### `getPosition()`

Returns the position of the Environment.

### `getDate()`

Returns the Environment date.

### `update($name)`

Updates an environment. Only the fields that are send will be updated.

### `getSensors()`

Returns a list of sensors which are connected to this environment. Returns a list of ### `Sensor `objects.

### `removeSensor($sensorID)`

Removes the selected sensor from the selected environment.

### `addSensors($sensorIds)`

Adds a sensor to an environment. To connect an individual sensor a sensor object with only the sensor id can be given and to connect a list of sensors a sensors object with an array of sensor ids can be given.

Class: Device.PHP
-----------------

*Handles all the Device actions*

### `Device($data, $api)`

Constructor. Requires a data object and the Api class.

### `getID()`

Returns the device ID.

### `getType()`

Returns the device type.

### `getUniqueID()`

Returns the unique device ID.

### `getMySensors($page, $perPage, $details)`

Returns the sensors that are physically connected to the device as a list of `Sensor` objects.

Class: Data.PHP
---------------

*Handles all the Data actions*

### `Data($data, $api)`
Constructor. Requires a data object and the Api class.

### `getID()`

Returns data object ID.

### `getSensorId()`

Returns the sensor ID of the data source.

### `getValue()`

Returns the value of the data object.

### `getDate()`

Returns the date when the data object is created.

### `getWeek()`

Returns the week when the data object is created.

### `getMonth()`

Returns the month when the data object is created.

### `getYear()`

Returns the year when the data object is created.

### `delete()`

Deletes a data point

### `getFileLocation()`

Returns the location of the file.

### `deleteFile()`

Deletes the file that is uploaded and stored under the name given in this sensor data value.


