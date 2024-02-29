package com.snazzy.crm.model;

import com.fasterxml.jackson.annotation.JsonManagedReference;
import jakarta.persistence.*;
import lombok.*;

import java.util.ArrayList;
import java.util.List;

@Getter
@Setter
@Builder
@NoArgsConstructor
@Entity
@Table(name = "account")
@AllArgsConstructor
public class Account {
    @Id
    @Column(name = "id", nullable = false)
    private Integer id;

    @Column(name = "name", nullable = false)
    private String name;

    @Column(name = "status")
    private String status;

    @OneToMany(mappedBy = "account", fetch = FetchType.LAZY)
    @OrderBy("id ASC")
    @JsonManagedReference
    private List<Contact> contacts = new ArrayList<>();

}