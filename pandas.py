import pandas as pd
from sklearn.neighbors import NearestNeighbors

# User data
users_data = {'user_id': [1, 2, 3, 4],
              'child_age': [3, 6, 9, 12],
              'preferred_color': [1, 0, 1, 0],  # 1 = likes blue, 0 = doesn't like blue
              'preferred_material': [1, 1, 0, 0]}  # 1 = likes cotton

# Product data
products_data = {'product_id': [101, 102, 103, 104],
                 'category': ['Onesies', 'Dresses', 'Onesies', 'Pajamas'],
                 'size': [3, 6, 9, 12]}  # Sizes in months

# DataFrames
user_df = pd.DataFrame(users_data)
product_df = pd.DataFrame(products_data)

# Nearest neighbor recommendation
user_preferences = user_df.drop(columns=['user_id'])
knn = NearestNeighbors(n_neighbors=1)
knn.fit(user_preferences)

# Recommend for user 1
user_1 = user_preferences.iloc[0].values.reshape(1, -1)
nearest_user = knn.kneighbors(user_1)

# Display recommended product
recommended_product = product_df.iloc[nearest_user[1][0]]
print(f"Recommended product for user 1: {recommended_product['product_id'].values}")


# Use preferences like "child_age", "preferred_color", and "preferred_material"
# to find similar users and recommend products that match their preferences.
