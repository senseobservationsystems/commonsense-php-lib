CommonSense PHP API
===================

A PHP class library for the communication between your PHP application and the Sense API. Easy to add in your application directory.

Class: class.Api.PHP
--------------------

*Class that handles all the API calls*

`api()`
Constructor

`getSessionId()`
Returns the session id if exists

`setSessionId(Integer $sessionid)`
Set the session id of a user. 

`getErrorLog()`
Returns the error log as a String. 

`login($username, $password)`
With this method a user can login with his username and md5 password hash. The function sets the needed session_id. This session_id is used for authentication. A user can be logged in on multiple locations. Returns true or false

`oauthLogin($key, $secret)`
With this method a user can login using oAuth. The function sets the needed session_id. This session_id is used for authentication at the oAuth authentication page.. Returns true or false

`logout()`
This method will logout the user by destroying its session.

`listDevices()`
All the users devices that have sensors will be returned as list of `Device `objects

`readDevice( Integer $id)`
Returns the details of a device that has sensors as a `Device `object

`readDeviceSensors($id, $page, $perPage, $details)`
Returns the sensors that are physically connected to the device as a list of `Sensor `objects

`addEnvironment($name, $floors, $gps_outlines, $position)`
This method creates a new environment. The gps_outline field should contain a list of latitude longitude points describing the outline of the environment.The list of points should create a polygon. The latitude longitude coordinates are separated by a space and each tuple by a comma. Optionally a third coordinate altitude can be specified after the longitude separated by a space. The gps_outline field can have 8000 characters. The position field should be the center of the environment which is also a gps point in the order latitude longitude altitude separated by spaces. The field floors indicates the amount of floors the environment has.

`deleteEnvironment( $id)`
This method deletes an environment.

`listEnvironments()`
This method returns a list of `Environment `objects of the current user.

`readEnvironment($id)`
The method returns the details of the selected environment, as a `Environment `object 

`updateEnvironment($id, $name)`
This method updates an environment. Only the fields that are send will be updated.

`listGroups()`
A list of groups will be returned where the current user is a member of. Returns a `Group` object

`createGroup($email, $name, $username, $password)`
This method will create a group to which the current user will be added. A group can optionally have a username and password which can be used for login. The password must be in md5 format.

`readGroup($id)`
This method returns the details of a group. Only members of a group can see the details of a group. Returns a `Group` object

`updateGroup($id, $email, $username, $password, $name)`
This method will update the details of a group. Only the values specified as input will be updates. Every member of the group can update the group details

`deleteGroup( $id)`
This method deletes the group if the group has no other members. If the group has other members then the current user will be removed from the group.

`listUsersOfGroup( $id)`
This methods returns the members of the group as a list of `User `objects. Only group members can perform this action.

`addUserToGroup($id, $userID, $userName)`
This method will add a user to the group. To add a user at least a username or user_id must be specified. Only members of the group can add a user to the group.

`listSensors($page, $perPage, $sharred, $owned, $physical)`
This method returns a list of `Sensor` objects to which the current user has access.

`createSensor($name, $displayName, $deviceType, $pagerType, $dataType, $dataStructure)`
This method will create a new sensor. A sensor can optionally have a pager_type which can be 'email' or 'sms'. Based on the pager_type a message with the current sensor value will be send. The data_type of a sensor can either be a value type (e.g. float, string) or json. With a json data_type a data_structure that specifies the structure of the json object is expected.

`readSensor($id)`
This method will returns a `Sensor` object.

`updateSensorDescription($id, $name, $displayName, $deviceType, $pagerType, $dataType, $dataStructure)`
This method will update an existing sensor.

`deleteSensor($id)`
This method will delete a sensor. If the current user is the owner of the sensor then the sensor will be removed from the current user and all other users. If the current user is not owner of the sensor then access to the sensor will be removed for this user.

`listSensorData( $id, $page, $perPage, $startDate, $endDate, $date, $next, $last, $sort, $total)`
This method will return a list of sensor data. The maximum amount of data points that can be retrieved at once are 1000 items.

`updateSensorSpecificData( $id, $value, $date)`
With this method sensor data can be uploaded. The uploaded data can either be a single value or an array.

`deleteSensorData( $sensorID, $dataID)`
This method deletes a data point

`getFileLocation( $sensorID, $dataID)`
The response header will contain a location header with the location of the file.

`deleteFile( $sensorID, $dataID)`
This method deletes the file that is uploaded and stored under the name given in this sensor data value.

`deleteAllFiles()`
This method deletes all the uploaded files of the user.

`uploadSensorData( $json)`
With this method sensor data can be uploaded at once for different sensors. The uploaded data can either be a single value or an array.

`readSensorEnvironment($id)`
The method returns the details of the environment of this sensor as `Environment` object.

`addSensorsToEnvironment( $id, $sensorIds)`
The method adds a sensor to an environment. To connect an individual sensor a sensor object with only the sensor id can be given and to connect a list of sensors a sensors object with an array of sensor ids can be given.

`listEnvironmentSensors($id)`
This method list the sensors which are connected to this environment. Returns a list of `Sensor` objects.

`removeSensorFromEnvironment($environmentID, $sensorID)`
This method removes the selected sensor from the selected environment.

`readParentDevice( $sensorID)`
This method returns a `Device` object to witch the sensor is connected.

`addToParentDevice( $sensorID, $deviceID, $type, $uuid)`
This method adds a sensor to a device. If the device does not exists then it will be created. Either a device_id or type and uuid combination is needed. The type of the sensor will then be automatically be set to 1.

`removeFromParentDevice( $sensorID)`
This method will remove a sensor from a device. The type of the device will then automatically be set to 0.

`sharredUsers( $sensorID)`
This method will list the users that have access to the sensor. Returns a list of `User` objects.

`addSharredUser( $sensorID, $userID, $username)`
This method will add a user to a sensor, giving the user access to the sensor and data. Only the owner of the sensor is able to upload data, mutate sensors and add users to their sensor. To add a user at least a username or user_id must be specified.

`removeSharredUser( $sensorID, $userID)`
This method removes a users from a sensor, which removes the access to the sensor for this user.

`listConnectedSensors( $sensorID)`
This method returns a list of `Sensor` objects that the sensor with uses.

`connectSensor( $sensorID, $connectedSensorID)`
This method connects a sensor to the sensor selected with <sensor_id>. The type of the selected sensor will be automatically set to 2 (virtual sensor).

`removeConnectedSensor( $sensorID, $connectedSensor)`
This method removes a sensor from the parent sensor. If the parent sensor does not have any sensors that it uses, its type will automatically be set to 0. If this parent sensor is also a service, then the connected sensor will also be disconnected from the service.

`listRunningServices( $sensorID)`
This method lists all the running services for a sensor. It also lists the data fields of the sensor that are used by each service. Returns a list of `Service` objects.

`listAvailableServices( $sensorID)`
This method lists all the available services for a sensor based on its data fields. Returns a list of `Service` objects.

`useService($sensorID, $json)`
This method connects a sensor to a service. In the POST data a service object is posted with the name of the service that is used. If the id of an existing service object is specified then this sensor will be connected to that service. Otherwise a new service will be created. In the optional array 'data_fields' the data fields of the sensor that should be used by this service can be specified. For every new service a virtual sensor is created. Data send from this service is stored under that virtual sensor. Optionally a sensor object with the name and device_type for the virtual sensor can be posted along with the creation of the service.

`disconnectFromService( $sensorID, $serviceID)`
This method disconnects the parent sensor from the service. The service will be stopped if it's not used by other sensors.

`listServiceMethods( $sensorID, $serviceID)`
This method lists all the available methods of the service selected with . These methods can be accessed to set and retrieve the settings of a service.

`runServiceGetMethod( $sensorID, $serviceID, $method)`
To retrieve information about a service, one of its 'get_methods' can be accessed by specifying the method name in the request url.

`runServiceSetMethod( $sensorID, $serviceID, $method, $parameters)`
To change specific settings of a service, one of its 'set_methods' can be accessed by specifying the method name in the request url. The parameters for the method are send in a parameters array. The response content is based on the method return type. If the method does not have a return value then it will return an object with result ok if the method succeeds.

`learnPattern( $SensorID, $serviceID, $startData, $endDate, $label)`
With this method states can be learned using previously stored data. This method is currently only available for the state_recognition_service and the pose_prediction_service. By giving a class label, start and end date, a state will be learned using the data from all the associated sensors from within the given time range.

`listAllAvailableServices()`
This method lists all the available services for all the sensors. Available services are selected based on their data fields.

`listAllUsers( $page, $perPage)`
This method lists all the users in the database with only their user_id, name and surname.

`createUser( $email, $username, $name, $surname, $mobile, $password)`
This method will create a user in the database. The username must be unique and the password must be a md5 hashed password. The response content will be contain the created user information. The uuid is a uniquely generated id which can be used to retrieve data without logging in.

`readUser($userID)`
This method returns a `User `object. Only the current user can be selected. 

`updateUser($userID, $email, $username, $name, $surname, $mobile, $password)`
This method updates the details of the user. Only the user_id of the current user can be selected.

`deleterUser($userID)`
This method will remove the user from the database together with his external services.

`readCurrentUser()`
This method returns the details of the current user as `User` object.

Class: User.PHP
---------------

*Handles all the user actions.*

`User($data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get the specific user id.

`getEmail()`
Get the E-mail address of the User.

`getName()`
Get the Name of the User.

`getSurname()`
Get the Surname of the User.

`getMobile()`
Get the Mobile number of the User.

`getOpenID()`
Get the Open ID of the User.

`getUniqueID()`
Get the Unique ID of the User.

`update($email, $username, $name, $surname, $mobile, $password)`
This method updates the details of the user. Only the logged in user can be updated.

`delete()`
Delete the user. Only the logged in user can delete himself.

`deleteAllMyData()`
Delete all the added data of the current User. Only the logged in user can delete his own data.

`addToGroup($groupid)`
This method will add a user to the group. To add a user at least a username or user_id must be specified. Only members of the group can add a user to the group.

Class: Service.PHP
------------------

*Handles all the service actions*

`Service($data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get the service ID.

`getName()`
Get the name of the Service.

`getData_fields()`
Get the Service data fields.

`disconnectSensor( $sensorID)`
This method disconnects the parent sensor from the service. The service will be stopped if it's not used by other sensors.

Class: Sensor.PHP
-----------------

*Handles all the Sensor actions*

`Sensor($data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get the ID of the Sensor.

`getName()`
Get the Sensor name.

`getDeviceType()`
Get the device type where the sensor belongs to.

`update($name, $displayName, $deviceType, $pagerType, $dataType, $dataStructure)`
This method will update the existing sensor.

`delete()`
This method will delete the sensor. If the current user is the owner of the sensor then the sensor will be removed from the current user and all other users. If the current user is not owner of the sensor then access to the sensor will be removed for this user.

`getData( $page, $perPage, $startDate, $endDate, $date, $next, $last, $sort, $total)`
This method will return a list of sensor `Data `objects. The maximum amount of data points that can be retrieved at once are 1000 items.

`updateData($value, $date)`
With this method sensor data can be uploaded. The uploaded data can either be a single value or an array.

`deleteData($dataID)`
This method deletes a data point

`uploadDataAsJson( $json)`
With this method sensor data can be uploaded at once for different sensors. The uploaded data can either be a single value or an array.

`getMyDevice()`
This method returns the details of the device to witch the sensor is connected as `Device` object.

`getEnvironment()`
The method returns the details of the environment of this sensor as `Environment `object.

`addSharredUser($userID, $userID)`
This method will add a user to a sensor, giving the user access to the sensor and data. Only the owner of the sensor is able to upload data, mutate sensors and add users to their sensor. To add a user at least a username or user_id must be specified.

`removeSharredUser($userID)`
This method removes a users from a sensor, which removes the access to the sensor for this user.

`connectSensor($connectedSensorID)`
This method connects a sensor to the sensor selected with <sensor_id>. The type of the selected sensor will be automatically set to 2 (virtual sensor).

`removeConnectedSensor($connectedSensor)`
This method removes a sensor from the parent sensor. If the parent sensor does not have any sensors that it uses, its type will automatically be set to 0. If this parent sensor is also a service, then the connected sensor will also be disconnected from the service.

`disconnectFromService( $serviceID)`
This method disconnects the parent sensor from the service. The service will be stopped if it's not used by other sensors.

Class: Group.PHP
----------------

*Handles all the Group actions*

`Group( $data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get the group ID.

`getName()`
Get the group name.

`getEmail()`
Get the registered group e-mail.

`update($email, $username, $password, $name)`
This method will update the details of a group. Only the values specified as input will be updates. Every member of the group can update the group details

`delete()`
This method deletes the group if the group has no other members. If the group has other members then the current user will be removed from the group.

`getUsers()`
This methods returns the members of the group as a list of `User `objects. Only group members can perform this action.

`addUser($userID, $userName)`
This method will add a user to the group. To add a user at least a username or user_id must be specified. Only members of the group can add a user to the group.

Class: Environment.PHP
----------------------

*Handles all the Environment actions*

`Environment($data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get the Environment ID.

`getName()`
Get the name of the Environment.

`getFloors()`
Get the number of floors of the Environment.

`getGpsOutline()`
Get the GPS outlines of the Environment.

`getPosition()`
Get the position of the Environment.

`getDate()`
Get the Environment date.

`update($name)`
This method updates an environment. Only the fields that are send will be updated.

`getSensors()`
This method list the sensors which are connected to this environment. Returns a list of `Sensor `objects.

`removeSensor($sensorID)`
This method removes the selected sensor from the selected environment.

`addSensors($sensorIds)`
The method adds a sensor to an environment. To connect an individual sensor a sensor object with only the sensor id can be given and to connect a list of sensors a sensors object with an array of sensor ids can be given.

Class: Device.PHP
-----------------

Class that handels all the Device actions

`Device($data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get the device ID.

`getType()`
Get the device type.

`getUniqueID()`
Get the unique device ID.

`getMySensors($page, $perPage, $details)`
Returns the sensors that are physically connected to the device as a list of `Sensor` objects.

Class: Data.PHP
---------------

*Handles all the Data actions*

`Data($data, $api )`
Constructor, requires a data object and the Api class.

`getID()`
Get data object ID.

`getSensorId()`
Get the parrent sensor ID.

`getValue()`
Get the value of the data object.

`getDate()`
Get the date when the data object is created.

`getWeek()`
Get the week when the data object is created.

`getMonth()`
Get the month when the data object is created.

`getYear()`
Get the year when the data object is created.

`delete()`
This method deletes a data point

`getFileLocation()`
The response header will contain a location header with the location of the file.

`deleteFile()`
This method deletes the file that is uploaded and stored under the name given in this sensor data value.

