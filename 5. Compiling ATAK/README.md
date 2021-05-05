# 5. Compiling ATAK

[<img src="img/ATAK_Civilian_Logo.png" width="100"/>](img/ATAK_Civilian_Logo.png)

How to compile ATAK on Ubuntu (linux)

A step by step process using the examples from _https://www.ballantyne.online_

Date Updated: as of the **`3rd of May 2021`**

### 1. Update your Ubuntu distro

```
sudo apt get update
```

### 2. Download ATAK's source code

https://github.com/deptofdefense/AndroidTacticalAssaultKit-CIV

### 3. Install and setup Android studio

In Ubuntu go to software and install Android studio.

Once Android studio is installed, launch it. We need to download and install the SDK’s ATAK will require to build.

In the release notes it mentions we need to use Android `API level 21` onward.

When the Android Studio welcome screen launches, click the configure menu (bottom right) and select SDK manager.

Now make sure you have a tick against each `API level` from `21` to `30`.

### 4. Install ATAK prerequisites

Now close Android studio and open a terminal in `AndroidTacticalAssaultKit-CIV/takthirdparty/`

```
sudo apt install build-essential git openjdk-8-jdk dos2unix autoconf automake libtool patch make tcl8.6 cmake swig ant
```

### 5. Build development environment

Open a terminal in `AndroidTacticalAssaultKit-CIV/takthirdparty/`

```
git clone https://github.com/synesissoftware/STLSoft-1.9.git stlsoft
```

### 6. Setup gdal

Get the modified version of gdal into position.

You may have a different on check in the `AndroidTacticalAssaultKit-CIV/depends/` directory and edit the version e.g: `gdal-X.X.X-mod.tar`

```
cp depends/gdal-2.2.3-mod.tar .
```

```
tar xf gdal-2.2.3-mod.tar
```

### 7. Get NDK r12b

Now we also need to get NDK r12b into a position where Android Studio and the make scripts can find it.

Installed `ndk` in home dir.

```
cd ~/home

mkdir ndk

cd ndk

wget https://dl.google.com/android/repository/android-ndk-r12b-linux-x86_64.zip

unzip android-ndk-r12b-linux-x86_64.zip
```

### 8. Add some environment variables globally

```
sudo nano /etc/environment
```

```
source /etc/environment
```

Now I had to restart my machine to get the environment variables to work.

Make sure JAVA_HOME environment variable & the NDK source location are correct.

### 9. Run Makes

We change to the takthirdparty directory and kick off the make recipes, all being well you can now go grab multiple cups of coffee and wait for all that building to finish;

Takes a long time...

```
make TARGET=android-arm64-v8a build_spatialite build_gdal build_commoncommo build_assimp
```

```
make TARGET=android-armeabi-v7a build_spatialite build_gdal build_commoncommo build_assimp
```

final build...

```
make TARGET=android-x86 build_spatialite build_gdal build_commoncommo build_assimp
```

### 10. Make debug keystore file

```
cd AndroidTacticalAssaultKit-CIV/atak/ATAK/app
mkdir keystore
cd keystore
keytool -genkeypair -alias androiddebugkey -keypass android -keystore debug.keystore -storepass android -dname "CN=Android Debug,O=Android,C=US" -validity 9999
```

### 11. Start Android studio

Open the app in `AndroidTacticalAssaultKit-CIV/atak/`.

Now fire up Android, we can get our build on! Open Android Studio and open the ATAK project under AndroidTacticalAssaultKit-CIV/atak/;

Go to `local.properties` and add your property data.


We should now be in a position to build a debug version of ATAK, we want to sync the project Gradle files to check everything is ok. 

Click the elephant logo with a blue arrow, located at the top right in the menu bar;

Click on the Gradle menu on the right side of the window, 

we can now expand the menu to find a task called assembleCivDebug, 

double click and this should kick off the debug APK build, 

this took 15 minutes or so the first time I ran it, 

so time for more caffeine! Make sure you use the task at the correct level in the Gradle hierarchy, 

if you’re getting random errors for file not found, you’re probably executing the wrong task;






- Links
    - https://www.ballantyne.online/build-an-atak-dev-environment/
    - https://github.com/deptofdefense/AndroidTacticalAssaultKit-CIV/blob/master/BUILDING.md







