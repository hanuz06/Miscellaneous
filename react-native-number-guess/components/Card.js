import React from "react";
import { View, StyleSheet } from "react-native";

const Card = (props) => {
  return (
    <View style={{ ...styles.card, ...props.style }}>{props.children}</View>
  );
};

const styles = StyleSheet.create({
  card: {
    shadowColor: "black", // Only works for iOS
    shadowOffset: { width: 0, height: 2 }, // Only works for iOS
    shadowRadius: 6, // Only works for iOS
    shadowOpacity: 0.3, // Only works for iOS
    backgroundColor: "white",
    elevation: 6, // Only works for Android
    padding: 20,
    borderRadius: 10,
  },
});

export default Card;
