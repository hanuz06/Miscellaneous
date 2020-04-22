import React from "react";
import {
  View,
  Text,
  StyleSheet,
  Button,
  Image,
  Dimensions,
  ScrollView,
} from "react-native";

import BodyText from "../components/BodyText";
import TitleText from "../components/TitleText";
import Colors from "../constants/colors";
import MainButton from "../components/MainButton";

const GameOverScreen = ({ roundsNumber, userNumber, onRestart }) => {
  return (
    // styles are applied to View component itself, and not to View component's children; styles applied to Text component also applied to Text component's children
    // Text component doesn't use Flexbox
    <ScrollView>
      <View style={styles.screen}>
        <TitleText>The game is over</TitleText>
        <View style={styles.imageContainer}>
          <Image
            style={styles.image}
            source={require("../assets/success.png")}
            // source={{uri:'https://media.gettyimages.com/photos/tent-on-mountain-summit-picture-id3003-007208'}}
            resizeMode="cover"
          />
        </View>
        <View style={styles.resultContainer}>
          <BodyText style={styles.resultText}>
            Your phone needed{" "}
            <Text style={styles.highlight}>{roundsNumber}</Text> rounds to guess
            the number <Text style={styles.highlight}>{userNumber}</Text>.
          </BodyText>
        </View>
        <MainButton onPress={onRestart}>NEW GAME</MainButton>
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  screen: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    paddingVertical: 10
  },
  // for images with uri we must put width and height as RN can't figure out the image size from internet; for local images usually it is not necessary provided images are perfectly sized;
  image: {
    width: "100%",
    height: "100%",
  },
  imageContainer: {
    width: Dimensions.get("window").width * 0.6,
    height: Dimensions.get("window").width * 0.6,
    borderRadius: (Dimensions.get("window").width * 0.6) / 2,
    borderWidth: 3,
    borderColor: "black",
    overflow: "hidden",
    marginVertical: Dimensions.get("window").height / 30,
  },
  highlight: {
    color: Colors.primary,
    fontFamily: "open-sans-bold",
  },
  resultText: {
    textAlign: "center",
    fontSize: Dimensions.get("window").height < 400 ? 16 : 20,
  },
  resultContainer: {
    marginHorizontal: 50,
    marginVertical: Dimensions.get("window").height / 60,
  },
});

export default GameOverScreen;
