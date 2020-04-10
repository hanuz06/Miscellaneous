import React from "react";
import { View, Text, StyleSheet, Button, Image } from "react-native";

import BodyText from "../components/BodyText";
import TitleText from "../components/TitleText";
import Colors from "../constants/colors";
import MainButton from "../components/MainButton";

const GameOverScreen = ({ roundsNumber, userNumber, onRestart }) => {
  return (
    // styles are applied to View component itself, and not to View component's children; styles applied to Text component also applied to Text component's children
    // Text component doesn't use Flexbox
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
          Your phone needed <Text style={styles.highlight}>{roundsNumber}</Text>{" "}
          rounds to guess the number{" "}
          <Text style={styles.highlight}>{userNumber}</Text>.
        </BodyText>
      </View>
      <MainButton onPress={onRestart}>NEW GAME</MainButton>     
    </View> 
  );
};

const styles = StyleSheet.create({
  screen: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
  },
  // for images with uri we must put width and height as RN can't figure out the image size from internet; for local images usually it is not necessary provided images are perfectly sized;
  image: {
    width: "100%",
    height: "100%",
  },
  imageContainer: {
    width: 300,
    height: 300,
    borderRadius: 150,
    borderWidth: 3,
    borderColor: "black",
    overflow: "hidden",
    marginVertical: 30,
  },
  highlight: {
    color: Colors.primary,
    fontFamily: "open-sans-bold",
  },
  resultText: {
    textAlign: "center",
    fontSize: 20
  },
  resultContainer: {
    marginHorizontal: 50,
    marginVertical: 15
  },
});

export default GameOverScreen;
